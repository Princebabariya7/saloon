<?php

namespace App\Http\Controllers\frontend;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Illuminate\Routing\Controller;

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

        session()->put('msg', 'payment accepted');
        return redirect(route('payment.index'));
    }

    public function view()
    {
        return view('payment.index');
    }

    public function invoice()
    {
        return view('order.orderInvoice');
    }
}
