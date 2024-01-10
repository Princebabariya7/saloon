<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class PackageUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'     => 'required|regex:/^[\pL\s]+$/u',
            'price'    => 'required|numeric',
            'detail'   => 'required',
            'duration' => 'required',
            'status'   => 'required'
        ];
    }
}
