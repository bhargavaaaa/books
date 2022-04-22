<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use DataTables;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public $moduleName = "User";
    public $route = "admin/users";
    public $view = "admin/users";

    public function index(Request $request)
    {
        $moduleName = $this->moduleName;
        return view($this->view . "/index", compact(['moduleName']));
    }

    public function getUserData(Request $request)
    {
        $users = User::with(['roles'])->select();

        return DataTables::eloquent($users)
            ->addColumn('action', function ($user) {
                $editUrl = route('users.edit', encrypt($user->id));
                $deleteId = encrypt($user->id);

                $activeUrl = url('admin/userActiveInactive/active/' . $user->id);
                $deactiveUrl = url('admin/userActiveInactive/deactive/' . $user->id);

                $approveUrl = url('admin/userApproveDisapprove/approve/' . $user->id);
                $disapproveUrl = url('admin/userApproveDisapprove/disapprove/' . $user->id);



                $action = '';
                if (auth()->user()->hasPermission('edit.users')) {
                    $action .= "<a href='" . $editUrl . "' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i> Edit</a>";
                }
                if (auth()->user()->hasPermission('delete.users')) {
                    $action .= " <a id='delete' href='#' data-id='" . $deleteId . "' class='btn btn-danger btn-xs delete'><i class='fa fa-trash'></i> Delete</a>";
                }

                if (auth()->user()->hasPermission('activeinactive.users')) {
                    if ($user->is_active == '0') {
                        $action .= " <a id='activate' href='" . $activeUrl . "' class='btn btn-success btn-xs activeUser'><i class='fa fa-check'></i> Activate</a>";
                    } else {
                        $action .= " <a id='deactivate' href='" . $deactiveUrl . "' class='btn btn-danger btn-xs inactiveUser'><i class='fa fa-times'></i> Deactivate</a>";
                    }
                }

                if (auth()->user()->hasPermission('approvedisapprove.users')) {
                    if ($user->is_approve == '0') {
                        $action .= " <a id='approve' href='" . $approveUrl . "' class='btn btn-info btn-xs activeUser'><i class='fa fa-check'></i> Approve</a>";
                    } else {
                        $action .= " <a id='disapprove' href='" . $disapproveUrl . "' class='btn btn-primary btn-xs inactiveUser'><i class='fa fa-times'></i> Disapprove</a>";
                    }
                }

                return $action;
            })
            ->addColumn('role', function ($user) {
                return $user->roles[0]->name;
            })
            ->rawColumns(['action', 'role'])
            ->addIndexColumn()
            ->make(true);
    }

    public function create(Request $request)
    {
        $moduleName = $this->moduleName;
        $roles = Role::all();
        $password = substr(md5(time()), 0, 8);
        return view($this->view . "/add", compact(['moduleName', 'roles', 'password']));
    }

    public function store(UserRequest $request)
    {
        $user = new User();
        DB::beginTransaction();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $role = Role::find($request->role_id);
            $user->attachRole($role);
        DB::commit();

        Helper::successMsg('insert', $this->moduleName);
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $moduleName = $this->moduleName;
        $user = User::with('roles')->where('id', decrypt($id))->first();
        $roles = Role::all();
        $role_id = $user->roles[0]->id;

        return view($this->view . "/edit", compact(['moduleName', 'user', 'role_id', 'roles']));
    }


    public function update(Request $request, $id)
    {
        $user = User::find(decrypt($id));
        DB::beginTransaction();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            $user->syncRoles($request->role_id);
        DB::commit();
        Helper::successMsg('update', $this->moduleName);

        return redirect()->route('users.index');
    }

    public function delete(Request $request)
    {
        $res = false;
        $user = User::with('roles')->where('id', decrypt($request->id))->first();
        DB::beginTransaction();
            $user->detachRole($user->roles[0]->id);
            $res = $user->delete();
        DB::commit();
        if ($res) {

            Helper::successMsg('delete', $this->moduleName);
        } else {
            Helper::failarMsg('custom', 'There might be an Error!');
        }
        return response()->json($res);
    }

    public function userActiveInactive($type, $id)
    {
        if ($type == 'active') {
            User::where('id', $id)->update(['is_active' => '1']);
            Helper::activeDeactiveMsg('active', $this->moduleName);
        } else {
            User::where('id', $id)->update(['is_active' => '0']);
            Helper::activeDeactiveMsg('inactive', $this->moduleName);
        }
        return redirect()->route('users.index');
    }

    public function userApproveDisapprove($type, $id)
    {
        if ($type == 'approve') {
            User::where('id', $id)->update(['is_approve' => '1']);
            Helper::activeDeactiveMsg('approve', $this->moduleName);
        } else {
            User::where('id', $id)->update(['is_approve' => '0']);
            Helper::activeDeactiveMsg('disapprove', $this->moduleName);
        }
        return redirect()->route('users.index');
    }


    public function checkUserEmail(Request $request)
    {
        $res = false;
        if (!isset($request->id)) {
            $userCheck = User::where('email', $request->email)->count();
        } else {
            $userCheck = User::where('email', $request->email)->where('id', '!=', $request->id)->count();
        }

        if ($userCheck > 0) {
            $res = false;
        } else {
            $res = true;
        }
        return response()->json($res);
    }
}
