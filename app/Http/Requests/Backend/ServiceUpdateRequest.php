<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ServiceUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required',
            'name'  => 'required|regex:/^[\pL\s]+$/u',
            'detail'   => 'required',
            'price'    => 'required|numeric',
            'duration' => 'required',
            'status'   => 'required'

        ];
    }
}
