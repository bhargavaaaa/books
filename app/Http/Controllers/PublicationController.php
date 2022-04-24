<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\PublicationRequest;
use App\Models\Board;
use App\Models\Publication;
use Illuminate\Http\Request;
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
        if ($request->file('image')) {
            $fileName = $request->image->extension();
        }

        $publication = Publication::create([
            'publication_name'  => ucfirst(trim($request->name)),
            'publication_desc'  => $request->description,
            'publication_photo' => $fileName,
        ]);

        $board_id =  $request->board;
        $publication->board()->attach($board_id);

        Helper::successMsg('insert', $this->moduleName);

        return redirect($this->route . 'index');
    }


    public function getData(Request $request)
    {
        $data = Publication::with(['board'])->select();

        return DataTables::eloquent($data)
            ->addColumn('action', function ($row) {
                $editUrl = route($this->route . '.edit', encrypt($row->id));
                $deleteId = encrypt($row->id);

                $activeUrl = url('admin/ActiveInactive/active/' . $row->id);
                $deactiveUrl = url('admin/ActiveInactive/deactive/' . $row->id);



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
                return $row->publication_desc;
            })
            ->rawColumns(['action','board_id', 'publication_desc'])
            ->addIndexColumn()
            ->make(true);
    }
}
