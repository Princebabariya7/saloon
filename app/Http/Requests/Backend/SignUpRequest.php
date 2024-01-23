<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstname'       => 'required|regex:/^[\pL\s]+$/u',
            'lastname'        => 'required|regex:/^[\pL\s]+$/u',
            'email'           => 'required|email',
            'password'        => 'required',
            'retype_password' => 'required|same:password',
        ];
    }
}
