<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstname' => 'required|alpha',
            'lastname'  => 'required|alpha',
            'mobile'    => 'required|numeric|digits:10',
            'email'     => 'required|email',
            //'password'   => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/',],
            //'repassword' => 'required|same:password',
            'address'   => 'required',
            'city'      => 'required',
            'state'     => 'required',
            'zipcode'   => 'required|numeric|digits:6',
        ];
    }
}
