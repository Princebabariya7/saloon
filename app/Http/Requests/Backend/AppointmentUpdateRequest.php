<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'categories' => 'required',
            'service_id' => 'required',
            'date'       => 'required',
            'time'       => 'required',
            'type'       => 'required',
            'status'     => 'required'

        ];
    }
}
