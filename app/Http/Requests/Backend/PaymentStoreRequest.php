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
            'buyer_name'    => 'required',
            'buyer_email'   => 'required|email',
            'buyer_address' => 'required',
            'cd_number'     => 'required|numeric',
            'exp_month'     => 'required',
            'exp_year'      => 'required',
            'cvv'           => 'required|numeric',
        ];
    }
}
