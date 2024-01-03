<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.view')->with('data', Payment::all());
    }

    public function store(PaymentRequest $request)
    {
        Payment::create([
            'buyer_name'    => $request->buyer_name,
            'buyer_email'   => $request->buyer_email,
            'buyer_address' => $request->buyer_address,
            'cd_number'     => $request->cd_number,
            'month'         => $request->month,
            'year'          => $request->year,
            'cvv'           => $request->cvv,
            'updated_at'    => now(),
            'created_at'    => now(),
        ]);

        session()->put('msg', 'qqq');
        return redirect(route('payment.index'));
    }
}
