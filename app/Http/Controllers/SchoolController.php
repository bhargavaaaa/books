<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\SchoolRequest;
use App\Models\Board;
use App\Models\Publication;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class SchoolController extends Controller
{
    public $moduleName = 'School';
    public $route = 'school';
    public $view = 'admin.school';


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
        return view($this->view . '/form', compact('moduleName', 'boards','publications'));
    }
    public function store(SchoolRequest $request)
    {
        $fileName = Null;
        if ($file = $request->file('image')) {
            $fileName = time() .".".$file->getClientOriginalExtension();
            $file->storeAs('school/',$fileName);
        }

        $school = School::create([
            'school_name'  => ucfirst(trim($request->name)),
            'school_desc'  => $request->description,
            'school_photo' => $fileName,
            'is_active' => $request->is_active,
        ]);

        $board_id =  $request->board;
        $school->board()->attach($board_id);

        $publication_id =  $request->publication;
        $school->publication()->attach($publication_id);

        Helper::successMsg('insert', $this->moduleName);

        return redirect(route($this->route . '.index'));
    }


    public function getData(Request $request)
    {
        $data = School::with(['board','publication'])->select();

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
            ->editColumn('publication_id',function($row){
                $publication_id = array();
                foreach($row->publication as $publication){
                    array_push($publication_id,$publication->publication_name);
                }
                return $publication_id;
            })
            ->editColumn('school_desc',function($row){
                return substr($row->school_desc,0,100);
            })
            ->editColumn('school_photo',function($row){
                if($row->school_photo != null){
                return '<img src="'.URL::to("/storage/app/school/".$row->school_photo).'" alt="image not load" heigth="100" width="150">';
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
            ->rawColumns(['action','board_id', 'school_desc','school_photo','publication_id','is_active'])
            ->addIndexColumn()
            ->make(true);
    }

    public function edit($id)
    {
        $moduleName = $this->moduleName;
        $boards = Board::get();
        $publications = Publication::get();
        $school = School::with(['board','publication'])->find(decrypt($id));
        $board_ids = array();
        foreach($school->board as $board){
        array_push($board_ids,$board->id);
        }
        $publication_ids = array();
        foreach($school->publication as $publication){
        array_push($publication_ids,$publication->id);
        }
        return view($this->view . '/_form', compact('moduleName', 'boards','publications','school','board_ids','publication_ids'));
    }

    public function update(SchoolRequest $request,$id)
    {
        $school = School::with('board')->where('id',decrypt($id))->first();

        $fileName = Null;
        if ($file = $request->file('image')) {
            if($request->old_image != null||$request->old_image != ''){
                try {
                unlink(storage_path('/app/school/'.$request->old_image));
            } catch (\Throwable $th) {}
            }
                $fileName = time() .".".$file->getClientOriginalExtension();
                $file->storeAs('school/',$fileName);
        }else{
            if($request->old_image == null||$request->old_image == ''){
                try {
                unlink(storage_path('/app/school/'.$school->school_photo));
            } catch (\Throwable $th) {}
            }
            $fileName = $request->old_image;
        }


        $school->update([
            'school_name'  => ucfirst(trim($request->name)),
            'school_desc'  => $request->description,
            'school_photo' => $fileName,
            'is_active' => $request->is_active,
        ]);

        if($request->board != null){
            $board_id =  $request->board;
            $school->board()->sync($board_id);
        }else{
            $school->board()->sync([]);
        }

        if($request->publication != null){
            $publication_id =  $request->publication;
            $school->publication()->sync($publication_id);
        }else{
            $school->publication()->sync([]);
        }

        Helper::successMsg('update', $this->moduleName);

        return redirect(route($this->route . '.index'));
    }

    public function delete(Request $request)
    {
        $res = false;
        $school = School::with(['board','publication'])->where('id', decrypt($request->id))->first();
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
        $school = School::find(decrypt($id));
        if($school->is_active == 1) {
            $school->update(['is_active' => 0]);
            Helper::activeDeactiveMsg('deactive',$this->moduleName);

        } else {
            $school->update(['is_active' => 1]);
            Helper::activeDeactiveMsg('active', $this->moduleName);
        }
        return redirect(route($this->route.'.index'));
    }
}
