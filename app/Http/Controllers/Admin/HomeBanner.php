<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\HomeBanner as ModelsHomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeBanner extends Controller
{
    public $moduleName = "Banner";
    public $route = "admin/banner";
    public $view = "admin/banner";

    public function index()
    {
        $moduleName = $this->moduleName;
        return view($this->view ."/index", compact('moduleName'));
    }

    public function getBannerData()
    {
        $banner = ModelsHomeBanner::select();

        $datatables = datatables()->eloquent($banner)
        ->addColumn('action', function($row){
            $editUrl = route('banner.view', encrypt($row->id));
            $deleteUrl = route('banner.delete', encrypt($row->id));
            $activeUrl = route('banner.activeInactive', encrypt($row->id));
            $deactiveUrl = route('banner.activeInactive', encrypt($row->id));

            $action = '';

            $action .= "<a href='" . $editUrl . "' class='btn btn-primary btn-xs'></i> View</a>";
            $action .= " <a id='delete' href='" . $deleteUrl . "' class='btn btn-danger btn-xs delete'><i class='fa fa-trash'></i> Delete</a>";
            if ($row->is_active == '0') {
                $action .= " <a id='activate' href='" . $activeUrl . "' class='btn btn-success btn-xs activeUser'><i class='fa fa-check'></i> Activate</a>";
            } else {
                $action .= " <a id='deactivate' href='" . $deactiveUrl . "' class='btn btn-danger btn-xs inactiveUser'><i class='fa fa-times'></i> Deactivate</a>";
            }

            return $action;
        })
        ->editColumn('image', function($row){
            if($row->image != null) {
                return '<img src="'. url('storage/app/banner/'. $row->image ) .'" alt="banner image" heigth="100" width="150">';
            } else {
                return '---- No Image ----';
            }
        })
        ->rawColumns(['action','image'])
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
            'image'       => 'required|mimes:jpeg,jpg,png',
        ]);


        if($validate) {
            DB::beginTransaction();
            $fileName = null;
            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $image->move('storage/app/banner/', $fileName);
            }

            $banner = ModelsHomeBanner::create([
                'name' => $request->name,
                'image' => $fileName,
                'is_active' => $request->is_active
            ]);

            DB::commit();
        }

        Helper::successMsg('insert', $this->moduleName);
        return redirect($this->route);
    }

    public function view($id)
    {
        $moduleName = $this->moduleName;
        $banner = ModelsHomeBanner::find(decrypt($id));
        return view($this->view ."/_form", compact('moduleName','banner'));
    }

    public function delete($id)
    {
        $banner = ModelsHomeBanner::find(decrypt($id));
        if($banner) {
            try{
                unlink(storage_path('app/banner/'. $banner->image));
            }catch(Throwable $e){
            }

            $banner->delete();
        }

        Helper::successMsg('delete', $this->moduleName);
        return redirect($this->route);
    }

    public function activeInactive($id)
    {
        $banner = ModelsHomeBanner::find(decrypt($id));
        if($banner->is_active == 1) {
            $banner->update(['is_active' => 0]);
            Helper::activeDeactiveMsg('deactive',$this->moduleName);

        } else {
            $banner->update(['is_active' => 1]);
            Helper::activeDeactiveMsg('active', $this->moduleName);
        }

        return redirect($this->route);
    }
}
