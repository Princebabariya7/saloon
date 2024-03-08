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
            'address'   => 'required',
            'city'      => 'required',
            'state'     => 'required',
            'zipcode'   => 'required|numeric|digits:6',
        ];
    }
}
