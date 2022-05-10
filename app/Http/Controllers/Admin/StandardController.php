<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Publication;
use App\Models\School;
use App\Models\Standard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StandardController extends Controller
{
    public $moduleName = 'Standard';
    public $route = 'admin/standard';
    public $view = 'admin/standard';

    public function index()
    {
        $moduleName = $this->moduleName;
        return view($this->view . '/index', compact('moduleName'));
    }

    public function getStandardData()
    {
        $standard = Standard::with(['board', 'publication', 'school'])->select();

        $datatables = datatables()->eloquent($standard)
            ->addColumn('action', function ($row) {
                $editUrl = route('standard.edit', encrypt($row->id));
                $deleteUrl = route('standard.delete', encrypt($row->id));
                $activeUrl = route('standard.activeInactive', encrypt($row->id));
                $deactiveUrl = route('standard.activeInactive', encrypt($row->id));

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
            ->editColumn('board_id', function ($row) {
                $board_id = array();
                foreach ($row->board as $board) {
                    array_push($board_id, $board->name);
                }
                return $board_id;
            })
            ->editColumn('publication_id', function ($row) {
                $publication_id = array();
                foreach ($row->publication as $publication) {
                    array_push($publication_id, $publication->publication_name);
                }
                return $publication_id;
            })
            ->editColumn('school_id', function ($row) {
                $school_id = array();
                foreach ($row->school as $school) {
                    array_push($school_id, $school->school_name);
                }
                return $school_id;
            })
            ->editColumn('standard_description', function ($row) {
                return substr($row->standard_description, 0, 100);
            })
            ->rawColumns(['action', 'board_id', 'publication_id', 'school_id', 'standard_description'])
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
        return view($this->view . '/form', compact('moduleName', 'boards', 'publications', 'schools'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'  => 'required',
        ]);

        if ($validate) {

            $standard = Standard::create([
                'standard_name'        => $request->name,
                'standard_description' => $request->description,
                'is_active'            => 1
            ]);

            $board_id =  $request->board;
            $standard->board()->attach($board_id);

            $publication_id =  $request->publication;
            $standard->publication()->attach($publication_id);

            $school_id = $request->school;
            $standard->school()->attach($school_id);
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

        $standard = Standard::with(['board', 'publication', 'school'])->find(decrypt($id));

        $board_ids = array();
        foreach ($standard->board as $board) {
            array_push($board_ids, $board->id);
        }

        $publication_ids = array();
        foreach ($standard->publication as $publication) {
            array_push($publication_ids, $publication->id);
        }

        $school_ids = array();
        foreach ($standard->school as $school) {
            array_push($school_ids, $school->id);
        }

        return view($this->view . '/_form', compact('moduleName', 'standard', 'boards', 'publications', 'schools', 'board_ids', 'publication_ids', 'school_ids'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name'  => 'required',
        ]);

        if ($validate) {

            $standard = Standard::with(['board', 'publication', 'school'])->find(decrypt($id));

            $standard->update([
                'standard_name'        => $request->name,
                'standard_description' => $request->description,
            ]);

            if ($request->board != null) {
                $board_id =  $request->board;
                $standard->board()->sync($board_id);
            } else {
                $standard->board()->sync([]);
            }

            if ($request->publication != null) {
                $publication_id =  $request->publication;
                $standard->publication()->sync($publication_id);
            } else {
                $standard->publication()->sync([]);
            }

            if ($request->school != null) {
                $school_id =  $request->school;
                $standard->school()->sync($school_id);
            } else {
                $standard->school()->sync([]);
            }
        }

        Helper::successMsg('update', $this->moduleName);

        return redirect($this->route);
    }

    public function standardActiveInactive($id)
    {
        $standard = Standard::find(decrypt($id));
        if ($standard->is_active == 1) {
            $standard->update(['is_active' => 0]);
            Helper::activeDeactiveMsg('deactive', $this->moduleName);
        } else {
            $standard->update(['is_active' => 1]);
            Helper::activeDeactiveMsg('active', $this->moduleName);
        }

        return redirect($this->route);
    }

    public function delete($id)
    {
        $standard = Standard::find(decrypt($id));
        DB::beginTransaction();
        $standard->board()->sync([]);
        $standard->publication()->sync([]);
        $standard->school()->sync([]);
        $standard->delete();
        DB::commit();

        Helper::successMsg('delete', $this->moduleName);
        return redirect($this->route);
    }
}
