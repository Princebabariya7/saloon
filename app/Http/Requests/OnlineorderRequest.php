<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OnlineorderRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $req                = $this->all();
        $req['is_package']  = true;
        $req['is_category'] = true;
        $req['is_service']  = true;

        if (isset($req['package']))
        {
            $req['is_package'] = $req['is_category'] = $req['is_service'] = false;
        }
        elseif (isset($req['categories']))
        {
            $req['is_category'] = $req['is_package'] = false;
        }
        elseif (isset($req['service']))
        {
            $req['is_package'] = $req['is_service'] = false;
        }
        $this->replace($req);
    }

    public function rules()
    {
        return [
            'package'          => 'required_if:is_package,true',
            'categories'       => 'required_if:is_category,true',
            'service'          => 'required_if:is_service,true',
            'address'          => 'required',
            'city'             => 'required',
            'state'            => 'required',
            'zipcode'          => 'required|numeric',
            'appointment_time' => 'required',
        ];
    }
}
