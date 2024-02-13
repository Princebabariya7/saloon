<?php

namespace App\Http\Controllers\frontend;

use App\Http\Requests\frontend\PaymentRequest;
use App\Models\Payment;
use Illuminate\Routing\Controller;
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
                'amount'               => 4949 * 100,
                'currency'             => 'usd',
                'payment_method_types' => ['card'],
                'payment_method_data'  => ['type' => 'card', 'card' => ['token' => $request->stripeToken]]
            ]);
            $intent->confirm();
            $transactionDetail = json_encode(['status' => true, 'message' => 'Payment Was Successfully']);

            $statusData = json_decode($transactionDetail, true); // Decode the JSON string to an associative array

            $status = $statusData['status'] == true ? 'Success' : 'Pending';

            Payment::create([
                'buyer_name'         => $request->buyer_name,
                'buyer_email'        => $request->buyer_email,
                'transaction_id'     => $request->stripeToken,
                'transaction_detail' => $transactionDetail,
                'gateway'            => 'Stripe',
                'appointment_id'     => $request->token,
                'status'             => $status,
                'updated_at'         => now(),
                'created_at'         => now(),
            ]);

            session()->put('msg', 'payment accepted');
            return response()->json(['status' => true, 'message' => 'Payment Was Successfully', 'url' => route('online.index')], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Payment failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function create($token)
    {
        return view('frontend.payment.index')->with('token', $token);
    }

    public function invoice()
    {
        return view('frontend.order.orderInvoice');
    }
}
