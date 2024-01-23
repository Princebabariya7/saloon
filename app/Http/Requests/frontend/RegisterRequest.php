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
            'date'       => 'before:2005-01-20',
            'number'     => 'required|numeric|digits:10',
            'email'      => 'required|email',
            'password'   => 'required',
            'repassword' => 'required|same:password',
            'address'          => 'required',
            'city'             => 'required',
            'state'            => 'required',
            'zipcode'          => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'gender.required' => 'We need to know your email address!',
        ];
    }
}
