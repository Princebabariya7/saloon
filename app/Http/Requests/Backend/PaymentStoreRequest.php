<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
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
