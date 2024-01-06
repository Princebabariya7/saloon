<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class ForgotRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'      => 'required|email',
            'password'   => 'required',
            'repassword' => 'required|same:password'
        ];
    }
}
