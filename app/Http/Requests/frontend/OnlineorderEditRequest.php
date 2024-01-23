<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class OnlineorderEditRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'categories' => 'required',
            'service_id'    => 'required',
            'type'       => 'required',
            'date'       => 'required',
        ];
    }
}
