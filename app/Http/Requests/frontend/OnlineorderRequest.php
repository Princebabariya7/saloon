<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class OnlineorderRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'categories'       => 'required',
            'service'          => 'required',
            'type'             => 'required',
            'date' => 'required',
        ];
    }
}
