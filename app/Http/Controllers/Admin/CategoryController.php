<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Category;
use App\Models\Publication;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class CategoryController extends Controller
{
    public $moduleName = 'Category';
    public $route = 'admin/category';
    public $view = 'admin/category';

    public function index()
    {
        $moduleName = $this->moduleName;
        return view($this->view . "/index", compact('moduleName'));
    }

    public function getCategoryData()
    {
        $category = Category::with(['board','publication','school'])->select();

        $datatables = datatables()->eloquent($category)
        ->addColumn('action', function($row){
            $editUrl = route('category.edit', encrypt($row->id));
            $deleteUrl = route('category.delete', encrypt($row->id));
            $activeUrl = route('category.activeInactive', encrypt($row->id));
            $deactiveUrl = route('category.activeInactive', encrypt($row->id));

            $action = '';

            $action .= "<a href='" . $editUrl . "' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i> Edit</a>";
            $action .= " <a id='delete' href='" . $deleteUrl . "' class='btn btn-danger btn-xs delete'><i class='fa fa-trash'></i> Delete</a>";
            if ($row->is_active == '0') {
                $action .= " <a id='activate' href='" . $activeUrl . "' class='btn btn-success btn-xs activeUser'><i class='fa fa-check'></i> Activate</a>";
            } else {
                $action .= " <a id='deactivate' href='" . $deactiveUrl . "' class='btn btn-danger btn-xs inactiveUser'><i class='fa fa-times'></i> Deactivate</a>";
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
        ->editColumn('publication_id',function($row){
            $publication_id = array();
            foreach($row->publication as $publication){
                array_push($publication_id,$publication->publication_name);
            }
            return $publication_id;
        })
        ->editColumn('school_id',function($row){
            $school_id = array();
            foreach($row->school as $school){
                array_push($school_id,$school->school_name);
            }
            return $school_id;
        })
        ->editColumn('category_description', function($row){
            return $row->category_description;
        })
        ->editColumn('category_image', function($row){
            if($row->category_image != null) {
                return '<img src="'. url('storage/app/category/'. $row->category_image ) .'" alt="publication image" heigth="100" width="150">';
            } else {
                return '---- No Image ----';
            }
        })
        ->rawColumns(['action','board_id','publication_id','school_id','category_description','category_image'])
        ->addIndexColumn()
        ->make(true);

        return $datatables;
    }

    public function create()
    {
        $moduleName = $this->moduleName;
        $boards = Board::get();
        $publications = Publication::get();
        $schools = School::get();
        return view($this->view . '/form',compact('moduleName','boards','publications','schools'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'  => 'required|unique:categories,category_name',
            'image'       => 'mimes:jpeg,jpg,png',
        ]);

        if($validate) {

            $fileName = Null;
            if ($file = $request->file('image')) {
                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $image->move('storage/app/category/', $fileName);
            }

            $category = Category::create([
                'category_name'        => $request->name,
                'category_description' => $request->description,
                'category_image'       => $fileName,
                'is_active'            => 1
            ]);

            $board_id =  $request->board;
            $category->board()->attach($board_id);

            $publication_id =  $request->publication;
            $category->publication()->attach($publication_id);

            $school_id = $request->school;
            $category->school()->attach($school_id);
        }

        Helper::successMsg('insert', $this->moduleName);
        return redirect($this->route);

    }

    public function edit($id)
    {
        $moduleName = $this->moduleName;
        $boards = Board::get();
        $publications = Publication::get();
        $schools = School::get();

        $category = Category::with(['board','publication','school'])->find(decrypt($id));

        $board_ids = array();
        foreach($category->board as $board) {
            array_push($board_ids,$board->id);
        }

        $publication_ids = array();
        foreach($category->publication as $publication) {
            array_push($publication_ids,$publication->id);
        }

        $school_ids = array();
        foreach($category->school as $school) {
            array_push($school_ids,$school->id);
        }

        return view($this->view .'/_form', compact('moduleName','category','boards','publications','schools','board_ids','publication_ids','school_ids'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name'  => 'required|unique:categories,category_name,'. $request->id,
            'image'       => 'mimes:jpeg,jpg,png',
        ]);

        if($validate) {

            $category = Category::with(['board','publication','school'])->find(decrypt($id));

            $fileName = Null;
            if ($file = $request->file('image')) {
                if($request->old_image != null||$request->old_image != ''){
                    try {
                    unlink(storage_path('/app/category/'.$request->old_image));
                } catch (\Throwable $th) {}
                }
                    $image = $request->file('image');
                    $fileName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move('storage/app/category/', $fileName);
            }else{
                if($request->old_image == null||$request->old_image == ''){
                    try {
                    unlink(storage_path('/app/category/'.$category->category_image));
                } catch (\Throwable $th) {}
                }
                $fileName = $request->old_image;
            }


            $category->update([
                'category_name'        => $request->name,
                'category_description' => $request->description,
                'category_image'       => $fileName,
            ]);

            if($request->board != null){
                $board_id =  $request->board;
                $category->board()->sync($board_id);
            }else{
                $category->board()->sync([]);
            }

            if($request->publication != null){
                $publication_id =  $request->publication;
                $category->publication()->sync($publication_id);
            }else{
                $category->publication()->sync([]);
            }

            if($request->school != null){
                $school_id =  $request->school;
                $category->school()->sync($school_id);
            }else{
                $category->school()->sync([]);
            }
        }

        Helper::successMsg('update', $this->moduleName);

        return redirect($this->route);
    }

    public function categoryActiveInactive($id)
    {
        $category = Category::find(decrypt($id));
        if($category->is_active == 1) {
            $category->update(['is_active' => 0]);
            Helper::activeDeactiveMsg('deactive',$this->moduleName);

        } else {
            $category->update(['is_active' => 1]);
            Helper::activeDeactiveMsg('active', $this->moduleName);
        }

        return redirect($this->route);
    }

    public function delete($id)
    {
        $category = Category::find(decrypt($id));
        DB::beginTransaction();
            if(isset($category->image)) {
                try{
                    unlink(storage_path('/app/ca$category/'. $category->image));
                }catch(Throwable $e){
                }
            }
            $category->board()->sync([]);
            $category->publication()->sync([]);
            $category->school()->sync([]);
            $category->delete();
        DB::commit();

        Helper::successMsg('delete', $this->moduleName);
        return redirect($this->route);
    }

    public function checkName(Request $request)
    {
        if(!isset($request->id)) {
            $category = Category::where('category_name', $request->name)->count();
        } else {
            $category = Category::where('category_name', $request->name)->where('id', '!=', $request->id)->count();
        }

        if($category > 0) {
            return response()->json(false);
        } else {
            return response()->json(true);
        }
    }
}
