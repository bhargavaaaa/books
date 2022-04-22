<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            //
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->id.',id,deleted_at,NULL',
            'role_id' => 'required',
            'password' => 'required',
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
            'name.required'         => 'Name is Required.',
            'email.required'        => 'Email is Required',
            'email.email'           => 'Email format is Invalid',
            'email.unique'          => 'Email already Exist',
            'role_id.required'      => 'Role is Required',
            'password.required'     => 'Password is Request'
        ];
    }
}
