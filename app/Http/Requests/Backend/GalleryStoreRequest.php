<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class GalleryStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'   => 'required|regex:/^[\pL\s]+$/u',
            'status' => 'required',
            'image'  => 'required|image'
        ];
    }
}
