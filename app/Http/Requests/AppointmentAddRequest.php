<?php

namespace App\Http\Requests;

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
            'package'          => 'required',
            'stylist'          => 'required',
            'appointment_time' => 'required'
        ];
    }
}
