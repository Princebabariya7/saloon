<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'buyer_name'    => 'required|regex:/^[\pL\s]+$/u',
            'buyer_email'   => 'required|email',
        ];
    }
}
