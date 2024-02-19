<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstname'  => 'required|alpha',
            'lastname'   => 'required|alpha',
            'gender'     => 'required',
            'number'     => 'required|numeric|digits:10',
            'email'      => 'required|email',
            'password'   => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/',],
            'repassword' => 'required|same:password',
            'address'    => 'required',
            'city'       => 'required',
            'state'      => 'required',
            'zipcode'    => 'required|numeric|digits:6',
        ];
    }

    public function messages()
    {
        return [
            'gender.required'   => 'Please Select gender',
            'password.required' => 'Password must be a minimum of 8 characters and contain at least one lowercase letter, one uppercase letter, one digit, and one special character (@$!%*#?&).'
        ];
    }
}
