<?php

namespace App\Http\Controllers\frontend;

use App\Http\Requests\frontend\PaymentRequest;
use App\Models\Payment;
use Illuminate\Routing\Controller;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function index()
    {
        return view('frontend.payment.view')->with('data', Payment::all());
    }

    public function store(PaymentRequest $request)
    {
        try
        {
            Stripe::setApiKey(config('services.stripe.secret'));

            $intent = PaymentIntent::create([
                'amount'               => 4949, // Amount in cents
                'currency'             => 'usd',
                'payment_method_types' => ['card'],
                'payment_method_data'  => ['type' => 'card', 'card' => ['token' => $request->stripeToken]]
            ]);
            $intent->confirm();
//            dd($intent);
//            $capture = PaymentIntent::retrieve($intent->id)->capture();

//            Payment::create([
//                'buyer_name'    => $request->buyer_name,
//                'buyer_email'   => $request->buyer_email,
//                'buyer_address' => $request->buyer_address,
//                'cd_number'     => $request->cd_number,
//                'month'         => $request->month,
//                'year'          => $request->year,
//                'cvv'           => $request->cvv,
//                'updated_at'    => now(),
//                'created_at'    => now(),
//            ]);

            session()->put('msg', 'payment accepted');
            return response()->json(['status' => true, 'message' => 'payment accepted', 'url' => route('online.create')], 200);
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function view()
    {
        return view('frontend.payment.index');
    }

    public function invoice()
    {
        return view('frontend.order.orderInvoice');
    }
}
