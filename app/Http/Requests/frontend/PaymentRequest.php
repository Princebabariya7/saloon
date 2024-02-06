<?php

namespace App\Http\Requests\frontend;

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
            'buyer_name'    => 'required',
            'buyer_email'   => 'required|email',
            'buyer_address' => 'required',
            'cd_number'     => 'required|numeric',
            'expiry'        => 'required',
            'cvv'           => 'required|numeric',
        ];
    }
}
