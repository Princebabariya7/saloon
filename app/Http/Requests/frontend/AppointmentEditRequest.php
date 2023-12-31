<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentEditRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'service'          => 'required',
            'stylist'          => 'required',
            'appointment_time' => 'required'
        ];
    }
}
