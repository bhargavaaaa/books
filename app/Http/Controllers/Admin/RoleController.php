<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\PermissionRole;
use jeremykenedy\LaravelRoles\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public $moduleName = "Roles";
    public $route = "admin/role";
    public $view = "admin/role";

    public function index(Request $request)
    {
        $moduleName = $this->moduleName;
        return view($this->view . "/index", compact(['moduleName']));
    }

    public function getRoleData(Request $request)
    {
        $roles = Role::select();
        return datatables()->eloquent($roles)
            ->addColumn('action', function ($roles) {
                $editUrl = route('role.edit', encrypt($roles->id));
                $deleteId = encrypt($roles->id);
                $action = '';
                if (auth()->user()->hasPermission('edit.roles')) {
                    $action .= "<a href='" . $editUrl . "' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i> Edit</a>";
                }
                if (auth()->user()->hasPermission('delete.roles')) {
                    $action .= " <a id='delete' href='#' data-id='" . $deleteId . "' class='btn btn-danger btn-xs delete'><i class='fa fa-trash'></i> Delete</a>";
                }

                return $action;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function create(Request $request)
    {
        $moduleName = $this->moduleName;
        $permissions = Permission::get()->groupBy('model');
        return view($this->view . "/add", compact(['moduleName', 'permissions']));
    }

    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
            $role = Role::create([
                'name' => $request->name,
                'description' => $request->description,
                'slug' => str_slug($request->name),
            ]);

            $role->attachPermission($request->permission);
        DB::commit();
        Helper::successMsg('insert', $this->moduleName);

        return redirect()->route('role.index');
    }

    public function edit(Request $request, $id)
    {
        $moduleName = $this->moduleName;
        $role = Role::find(decrypt($id));
        $permissions = Permission::get()->groupBy('model');

        $role_permission = PermissionRole::where('role_id', decrypt($id))->get()->pluck('permission_id')->toArray();
        return view($this->view . "/edit", compact(['moduleName', 'role', 'permissions', 'role_permission']));
    }

    public function update(RoleRequest $request, $id)
    {
        $res = false;
        $role = Role::find(decrypt($id));
        DB::beginTransaction();
        $role->name = $request->name;
        $role->description = $request->description;
        $role->slug = str_slug($request->name);
        $res = $role->save();

        $role->syncPermissions($request->permission);
        DB::commit();
        if ($res) {
            Helper::successMsg('update', $this->moduleName);
        } else {
            Helper::failarMsg('custom', 'There might be an Error!');
        }
        return redirect()->route('role.index');
    }

    public function delete(Request $request)
    {
        $res = false;
        $res2 = false;
        if (isset($request->id)) {
            DB::beginTransaction();
            $role = Role::with(['user'])->where('id',decrypt($request->id))->first();
            foreach($role->user as $key => $user)
            {
                $delUser = User::find($user->id);
                $delUser->detachRoles($role);
                $res2 = $delUser->delete(); 
            }

            $role->detachAllPermissions();
            $res = $role->delete();
            DB::commit();
        }
        if ($res && $res2) {
            Helper::successMsg('delete', $this->moduleName);
        } else {
            Helper::failarMsg('custom', 'There might be an Error!');
        }
        return response()->json($res);
    }

    public function checkRoleName(Request $request)
    {
        $res = false;
        if (!isset($request->id)) {
            $checkRoleName = Role::where('name', $request->name)->count();
        } else {
            $checkRoleName = Role::where('name', $request->name)->where('id', '!=', $request->id)->count();
        }

        if ($checkRoleName > 0) {
            $res = false;
        } else {
            $res = true;
        }
        return response()->json($res);
    }
}
