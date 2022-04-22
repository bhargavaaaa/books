<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use  Helper;

class ChangePasswordController extends Controller
{
    public $route = 'changePassword';
    public $moduleName = 'Change Password';
    public $view = 'admin.changepassword';

    public function index()
    {
        $route = $this->route;
        $moduleName = $this->moduleName;
        return view($this->view.'/form', compact('route','moduleName'));
    }

    public function checkOldPassword(Request $request){

        $oldPassword = $request->old_password;
        $user = User::where('id', auth()->user()->id)->first();

        if (!Hash::check($oldPassword, $user->password)) {
            echo(json_encode(false));
        } else {
            echo(json_encode(true));
        }
    }

    public function updateUserPassword(ChangePasswordRequest $request)
    {
        $oldPassword = $request->old_password;
        $user = User::where('id', auth()->user()->id)->first();
        if (!Hash::check($oldPassword, $user->password)) {
            return redirect($this->route)
            ->with('successmessage','Old Password Is Wrong');

        } else {
            User::where('id', auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        }

        Helper::successMsg('update', 'Change Password');
        return redirect('admin/changePassword');
    }
}
