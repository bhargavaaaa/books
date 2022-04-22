<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password'     => 'required',
            'new_password'     => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'old_password.required'         => 'Old Password Is Required',
            'new_password.required'         => 'New Password Is Required',
            'new_password.min'              => 'Password Minimum 8 Characters',
            'confirm_password.required'     => 'Confirm Password Is Required',
            'confirm_password.same'         => 'Password And Confirm Password Does Not Match',
        ];
    }
}
