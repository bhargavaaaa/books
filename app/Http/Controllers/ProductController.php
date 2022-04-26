<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\SchoolRequest;
use App\Models\Board;
use App\Models\Category;
use App\Models\Product;
use App\Models\Publication;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public $moduleName = 'Product';
    public $route = 'product';
    public $view = 'admin.product';

    public function index()
    {
        $moduleName = $this->moduleName;
        $boards = Board::get();
        return view($this->view . '/index', compact('moduleName', 'boards'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;
        $boards = Board::get();
        $publications = Publication::get();
        $schools = School::where('is_active',1)->get();
        $categories = Category::where('is_active',1)->get();
        return view($this->view . '/form', compact('moduleName', 'boards','schools','publications','categories'));
    }
    public function store(SchoolRequest $request)
    {
        $fileName = Null;
        if ($file = $request->file('image')) {
            $fileName = time() .".".$file->getClientOriginalExtension();
            $file->storeAs('product/',$fileName);
        }
        $attr = array();
        $attribute_name = $request->attribute_name;
        $attribute_value = $request->attribute_value;
        for($i=0;$i<count($request->attribute_name);$i++){
            $attr[$attribute_name[$i]] = $attribute_value[$i];
        }

        $product = Product::create([
            'product_name'  => ucfirst(trim($request->name)),
            'sku'  => str_slug($request->name),
            'product_desc'  => $request->description,
            'product_photo' => $fileName,
            'cutout_price' => $request->cutout_price,
            'attributes' => json_encode($attr),
            'sale_price' => $request->sale_price,
            'is_active' => $request->is_active,
        ]);

        $board_id =  $request->board;
        $product->board()->attach($board_id);

        $publication_id =  $request->publication;
        $product->publication()->attach($publication_id);

        $school_id =  $request->school;
        $product->school()->attach($school_id);

        $category_id =  $request->category;
        $product->category()->attach($category_id);

        Helper::successMsg('insert', $this->moduleName);

        return redirect(route($this->route . '.index'));
    }


    public function getData(Request $request)
    {
        $data = Product::with(['board','publication','school'])->select();

        return DataTables::eloquent($data)
            ->addColumn('action', function ($row) {
                $editUrl = route($this->route . '.edit', encrypt($row->id));
                $deleteId = encrypt($row->id);

                $activeUrl = route('school.activeInactive' ,encrypt($row->id));
                $deactiveUrl = route('school.activeInactive',encrypt($row->id));

                $action = '';
                if (auth()->user()->hasPermission('edit.schools')) {
                    $action .= "<a href='" . $editUrl . "' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i> Edit</a>";
                }
                if (auth()->user()->hasPermission('delete.schools')) {
                    $action .= " <a id='delete' href='#' data-id='" . $deleteId . "' class='btn btn-danger btn-xs delete'><i class='fa fa-trash'></i> Delete</a>";
                }

                if (auth()->user()->hasPermission('activeinactive.schools')) {
                    if ($row->is_active == '0') {
                        $action .= " <a id='activate' href='" . $activeUrl . "' class='btn btn-success btn-xs activeUser'><i class='fa fa-check'></i> Activate</a>";
                    } else {
                        $action .= " <a id='deactivate' href='" . $deactiveUrl . "' class='btn btn-danger btn-xs inactiveUser'><i class='fa fa-times'></i> Deactivate</a>";
                    }
                }
                return $action;
            })
            ->editColumn('board_id',function($row){
                $board_id = array();
                foreach($row->board as $board){
                    array_push($board_id,$board->name);
                }
                return $board_id;
            })
            ->editColumn('category_id',function($row){
                $category_id = array();
                foreach($row->category as $category){
                    array_push($category_id,$category->category_name);
                }
                return $category_id;
            })
            ->editColumn('school_id',function($row){
                $school_id = array();
                foreach($row->school as $school){
                    array_push($school_id,$school->school_name);
                }
                return $school_id;
            })
            ->editColumn('publication_id',function($row){
                $publication_id = array();
                foreach($row->publication as $publication){
                    array_push($publication_id,$publication->publication_name);
                }
                return $publication_id;
            })
            ->editColumn('product_desc',function($row){
                return $row->product_desc;
            })
            ->editColumn('product_photo',function($row){
                if($row->product_photo != null){
                return '<img src="'.URL::to("/storage/app/product/".$row->product_photo).'" alt="image not load" heigth="100" width="150">';
            }else{
                return '---- No Image ----';
                }
            })
            ->editColumn('is_active',function($row){
                if($row->is_active == 1){
                    return '<span class="badge badge-success">Active</span>';
                }else{
                    return '<span class="badge badge-danger">In Active</span>';
                }
            })
            ->rawColumns(['action','board_id', 'product_desc','product_photo','publication_id','is_active'])
            ->addIndexColumn()
            ->make(true);
    }

    public function edit($id)
    {
        $moduleName = $this->moduleName;
        $boards = Board::get();
        $publications = Publication::get();
        $product = Product::with(['board','publication','school','category'])->find(decrypt($id));

        $schools = School::where('is_active',1)->get();
        $categories = Category::where('is_active',1)->get();

        $board_ids = array();
        foreach($product->board as $board){
        array_push($board_ids,$board->id);
        }

        $publication_ids = array();
        foreach($product->publication as $publication){
        array_push($publication_ids,$publication->id);
        }

        $school_ids = array();
        foreach($product->school as $school){
        array_push($school_ids,$school->id);
        }

        $category_ids = array();
        foreach($product->category as $category){
        array_push($category_ids,$category->id);
        }
        $attr = json_decode($product->attributes,true);
        return view($this->view . '/_form', compact('moduleName','product','attr', 'boards','publications','schools','categories','board_ids','publication_ids','school_ids','category_ids'));
    }

    public function update(SchoolRequest $request,$id)
    {
        $product = Product::with('board')->where('id',decrypt($id))->first();

        $fileName = Null;
        if ($file = $request->file('image')) {
            if($request->old_image != null||$request->old_image != ''){
                try {
                unlink(storage_path('/app/product/'.$request->old_image));
            } catch (\Throwable $th) {}
            }
                $fileName = time() .".".$file->getClientOriginalExtension();
                $file->storeAs('product/',$fileName);
        }else{
            if($request->old_image == null||$request->old_image == ''){
                try {
                unlink(storage_path('/app/product/'.$product->product_photo));
            } catch (\Throwable $th) {}
            }
            $fileName = $request->old_image;
        }

        $attr = array();
        $attribute_name = $request->attribute_name;
        $attribute_value = $request->attribute_value;
        for($i=0;$i<count($request->attribute_name);$i++){
            $attr[$attribute_name[$i]] = $attribute_value[$i];
        }


        $product->update([
            'product_name'  => ucfirst(trim($request->name)),
            'sku'  => str_slug($request->name),
            'product_desc'  => $request->description,
            'product_photo' => $fileName,
            'cutout_price' => $request->cutout_price,
            'attributes' => json_encode($attr),
            'sale_price' => $request->sale_price,
            'is_active' => $request->is_active,
        ]);

        if($request->board != null){
            $board_id =  $request->board;
            $product->board()->sync($board_id);
        }else{
            $product->board()->sync([]);
        }

        if($request->publication != null){
            $publication_id =  $request->publication;
            $product->publication()->sync($publication_id);
        }else{
            $product->publication()->sync([]);
        }

        if($request->school != null){
            $school_id =  $request->school;
            $product->school()->sync($school_id);
        }else{
            $product->school()->sync([]);
        }

        if($request->category != null){
            $category_id =  $request->category;
            $product->category()->attach($category_id);
        }else{
            $product->category()->sync([]);
        }


        Helper::successMsg('update', $this->moduleName);

        return redirect(route($this->route . '.index'));
    }

    public function delete(Request $request)
    {
        $res = false;
        $school = Product::with(['board','publication'])->where('id', decrypt($request->id))->first();
        DB::beginTransaction();
            $school->board()->sync([]);
            $school->publication()->sync([]);
            $res = $school->delete();
        DB::commit();
        if ($res) {

            Helper::successMsg('delete', $this->moduleName);
        } else {
            Helper::failarMsg('custom', 'There might be an Error!');
        }
        return response()->json($res);
    }

    public function ActiveInactive($id)
    {
        $school = Product::find(decrypt($id));
        if($school->is_active == 1) {
            $school->update(['is_active' => 0]);
            Helper::activeDeactiveMsg('deactive',$this->moduleName);

        } else {
            $school->update(['is_active' => 1]);
            Helper::activeDeactiveMsg('active', $this->moduleName);
        }
        return redirect(route($this->route.'.index'));
    }
    public function checkName(Request $request){
        if(!isset($request->id)){
            $product = Product::where('product_name','=',$request->name)->count();
        }else{
           $product = Product::where('product_name','=',$request->name)->where('id','!=',$request->id)->count();
        }
        if($product > 0){
            echo json_encode(false);
        }else{
            echo json_encode(true);
        }
    }
}
