<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CMSPageController extends Controller
{
    public $moduleName = 'CMS Page';
    public $route = 'admin/cms_page';
    public $view = 'admin/cms_page';

    public function index()
    {
        $moduleName = $this->moduleName;
        return view($this->view . '/index', compact('moduleName'));
    }

    public function getCmsPageData()
    {
        $cmsPage = CmsPage::select();

        $datatables = datatables()->eloquent($cmsPage)
        ->addColumn('action', function($row) {
            $editUrl = route('cms_page.edit', encrypt($row->id));
            $deleteUrl = route('cms_page.delete', encrypt($row->id));

            $action = '';

            $action .= "<a href='" . $editUrl . "' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i> Edit</a>";
            if($row->type != 'inbuild') {
                $action .= " <a id='delete' href='" . $deleteUrl . "' class='btn btn-danger btn-xs delete'><i class='fa fa-trash'></i> Delete</a>";
            }

            return $action;
        })
        ->editColumn('description', function($row) {
            return substr($row->description,0,100);
        })
        ->rawColumns(['action','description'])
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
            'name'  => 'required',
        ]);

        if($validate) {
            DB::beginTransaction();
                $cmsPage = CmsPage::create(['name' => $request->name, 'description' => $request->description]);
            DB::commit();
        }

        Helper::successMsg('insert', $this->moduleName);
        return redirect($this->route);
    }

    public function edit($id)
    {
        $moduleName = $this->moduleName;
        $cmsPage = CmsPage::find(decrypt($id));
        return view($this->view . '/_form', compact('moduleName','cmsPage'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name'  => 'required',
        ]);

        if($validate) {
            $cmsPage = CmsPage::find(decrypt($id));
            DB::beginTransaction();
                $cmsPage->update(['name' => $request->name, 'description' => $request->description]);
            DB::commit();
        }

        Helper::successMsg('update', $this->moduleName);
        return redirect($this->route);
    }

    public function delete($id)
    {
        $cmsPage = CmsPage::find(decrypt($id));
        DB::beginTransaction();
            $cmsPage->delete();
        DB::commit();

        Helper::successMsg('delete', $this->moduleName);
        return redirect($this->route);

    }

}
