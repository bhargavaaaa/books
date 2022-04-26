<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\PublicationRequest;
use App\Models\Board;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class PublicationController extends Controller
{
    public $moduleName = 'Publication';
    public $route = 'publication';
    public $view = 'admin.publication';


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
        return view($this->view . '/form', compact('moduleName', 'boards'));
    }
    public function store(PublicationRequest $request)
    {
        $fileName = Null;
        if ($file = $request->file('image')) {
            $fileName = time() .".".$file->getClientOriginalExtension();
            $file->storeAs('publication/',$fileName);
        }


        $publication = Publication::create([
            'publication_name'  => ucfirst(trim($request->name)),
            'publication_desc'  => $request->description,
            'publication_photo' => $fileName,
            'is_active' => $request->is_active,
        ]);

        $board_id =  $request->board;
        $publication->board()->attach($board_id);

        Helper::successMsg('insert', $this->moduleName);

        return redirect(route($this->route . '.index'));
    }


    public function getData(Request $request)
    {
        $data = Publication::select();

        return DataTables::eloquent($data)
            ->addColumn('action', function ($row) {
                $editUrl = route($this->route . '.edit', encrypt($row->id));
                $deleteId = encrypt($row->id);

                $activeUrl = route('publication.activeInactive',encrypt($row->id));
                $deactiveUrl = route('publication.activeInactive',encrypt($row->id));



                $action = '';
                if (auth()->user()->hasPermission('edit.publications')) {
                    $action .= "<a href='" . $editUrl . "' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i> Edit</a>";
                }
                if (auth()->user()->hasPermission('delete.publications')) {
                    $action .= " <a id='delete' href='#' data-id='" . $deleteId . "' class='btn btn-danger btn-xs delete'><i class='fa fa-trash'></i> Delete</a>";
                }

                if (auth()->user()->hasPermission('activeinactive.publications')) {
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
            ->editColumn('publication_desc',function($row){
                return substr($row->publication_desc,0,100);
            })
            ->editColumn('is_active',function($row){
                if($row->is_active == 1){
                    return '<span class="badge badge-success">Active</span>';
                }else{
                    return '<span class="badge badge-danger">In Active</span>';
                }
            })
            ->editColumn('publication_photo',function($row){
                if($row->publication_photo != null){
                return '<img src="'.URL::to("/storage/app/publication/".$row->publication_photo).'" alt="publication image" heigth="100" width="150">';
            }else{
                return '---- No Image ----';
                }
            })
            ->rawColumns(['action','board_id', 'publication_desc','publication_photo','is_active'])
            ->addIndexColumn()
            ->make(true);
    }

    public function edit($id)
    {
        $moduleName = $this->moduleName;
        $boards = Board::get();
        $publication = Publication::with('board')->find(decrypt($id));
        $board_ids = array();
        foreach($publication->board as $board){
        array_push($board_ids,$board->id);
        }
        return view($this->view . '/_form', compact('moduleName', 'boards','publication','board_ids'));
    }

    public function update(PublicationRequest $request,$id)
    {
        $publication = Publication::with('board')->where('id',decrypt($id))->first();

        $fileName = Null;
        if ($file = $request->file('image')) {
            if($request->old_image != null||$request->old_image != ''){
                try {
                unlink(storage_path('/app/publication/'.$request->old_image));
            } catch (\Throwable $th) {}
            }
                $fileName = time() .".".$file->getClientOriginalExtension();
                $file->storeAs('publication/',$fileName);
        }else{
            if($request->old_image == null||$request->old_image == ''){
                try {
                unlink(storage_path('/app/publication/'.$publication->publication_photo));
            } catch (\Throwable $th) {}
            }
            $fileName = $request->old_image;
        }


        $publication->update([
            'publication_name'  => ucfirst(trim($request->name)),
            'publication_desc'  => $request->description,
            'publication_photo' => $fileName,
            'is_active' => $request->is_active,
        ]);

        if($request->board != null){
            $board_id =  $request->board;
            $publication->board()->sync($board_id);
        }else{
            $publication->board()->sync([]);
        }

        Helper::successMsg('update', $this->moduleName);

        return redirect(route($this->route . '.index'));
    }

    public function delete(Request $request)
    {
        $res = false;
        $publication = Publication::with('board')->where('id', decrypt($request->id))->first();
        DB::beginTransaction();
            $publication->board()->sync([]);
            $res = $publication->delete();
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
        $publication = Publication::find(decrypt($id));
        if($publication->is_active == 1) {
            $publication->update(['is_active' => 0]);
            Helper::activeDeactiveMsg('deactive',$this->moduleName);

        } else {
            $publication->update(['is_active' => 1]);
            Helper::activeDeactiveMsg('active', $this->moduleName);
        }

        return redirect(route($this->route.'.index'));
    }
}
