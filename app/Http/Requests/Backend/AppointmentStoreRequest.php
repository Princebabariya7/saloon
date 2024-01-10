<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'categories' => 'required|regex:/^[\pL\s]+$/u',
            'service'    => 'required',
            'date'       => 'required',
            'type'       => 'required',
            'status'        => 'required'
        ];
    }
}
