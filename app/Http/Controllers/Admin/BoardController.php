<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class BoardController extends Controller
{
    public $moduleName = "Board";
    public $route = "admin/board";
    public $view = "admin/board";

    public function index()
    {
        $moduleName = $this->moduleName;
        return view($this->view ."/index", compact('moduleName'));
    }

    public function getBoardData()
    {
        $board = Board::select();

        $datatables = datatables()->eloquent($board)
        ->addColumn('action', function($row){
            $editUrl = route('board.edit', encrypt($row->id));
            $deleteUrl = route('board.delete', encrypt($row->id));
            $activeUrl = route('board.activeInactive', encrypt($row->id));
            $deactiveUrl = route('board.activeInactive', encrypt($row->id));

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
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);

        return $datatables;
    }

    public function create()
    {
        $moduleName = $this->moduleName;
        return view($this->view ."/form", compact('moduleName'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'board_name'  => 'required|unique:boards,name',
            'image'       => 'mimes:jpeg,jpg,png',
        ]);

        if($validate) {
            DB::beginTransaction();

            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $image->move('storage/app/board/', $fileName);
            } else {
                $fileName = '';
            }

            $board = Board::create([
                'name'        => $request->board_name,
                'image'       => $fileName,
                'description' => $request->description,
                'is_active'   => $request->is_active
            ]);

            DB::commit();
        }

        Helper::successMsg('insert', $this->moduleName);
        return redirect($this->route);
    }

    public function edit($id)
    {
        $moduleName = $this->moduleName;
        $board = Board::find(decrypt($id));
        return view($this->view . '/_form', compact('moduleName','board'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'board_name'  => 'required|unique:boards,name,'. $request->id,
            'image'       => 'mimes:jpeg,jpg,png',
        ]);

        if($validate) {
            DB::beginTransaction();

                $board = Board::find(decrypt($id));

                if($request->hasFile('image'))
                {
                    try{
                        unlink(storage_path('app/board/'. $board->image));
                    }catch(Throwable $e){
                    }

                    $image = $request->file('image');
                    $fileName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move('storage/app/board/', $fileName);
                } else {
                    $fileName = $board->image;
                }

                $board->update([
                    'name'        => $request->board_name,
                    'image'       => $fileName,
                    'description' => $request->description,
                    'is_active'   => $request->is_active
                ]);
            DB::commit();
        }

        Helper::successMsg('update', $this->moduleName);
        return redirect($this->route);
    }

    public function delete($id)
    {
        $board = Board::find(decrypt($id));
        DB::beginTransaction();
            $board->delete();
        DB::commit();

        Helper::successMsg('delete', $this->moduleName);
        return redirect($this->route);
    }

    public function checkBoardName(Request $request)
    {
        if(!isset($request->id)) {
            $board = Board::where('name', $request->board_name)->count();
        } else {
            $board = Board::where('name', $request->board_name)->where('id', '!=', $request->id)->count();
        }

        if($board > 0) {
            return response()->json(false);
        } else {
            return response()->json(true);
        }
    }

    public function boardActiveInactive($id)
    {
        $board = Board::find(decrypt($id));
        if($board->is_active == 1) {
            $board->update(['is_active' => 0]);
            Helper::activeDeactiveMsg('deactive',$this->moduleName);

        } else {
            $board->update(['is_active' => 1]);
            Helper::activeDeactiveMsg('active', $this->moduleName);
        }

        return redirect($this->route);
    }
}
