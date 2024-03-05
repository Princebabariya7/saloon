<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentAddRequest extends FormRequest
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
            'type'       => 'required',
            'time'       => 'required',
            'date'       => 'required'
        ];
    }
}
