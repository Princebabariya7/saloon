<?php

namespace App\Http\Controllers\Backend;


use App\Http\Requests\Backend\PaymentStoreRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $search   = $request->input('search', '');
        $status   = $request->input('status', '');
        $payments = Payment::when($search, function ($query) use ($search)
        {
            return $query->where(function ($query) use ($search)
            {
                $query->orWhere('buyer_name', 'LIKE', '%' . $search . '%');
            });

        })->when($status, function ($query) use ($status)
        {
            return $query->where('status', $status);
        })->paginate(5);
        return view('Backend.payment.index')->with('payments', $payments);
    }

    public function create($token)
    {
        return view('Backend.payment.payment_form')->with('token',$token);
    }

    public function store(PaymentStoreRequest $request)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $intent = PaymentIntent::create([
                'amount'               => 821275,
                'currency'             => 'usd',
                'payment_method_types' => ['card'],
                'payment_method_data'  => ['type' => 'card', 'card' => ['token' => $request->stripeToken]]
            ]);

            $transactionDetail = json_encode(['status' => true, 'message' => 'Payment Was Successfully']);

            Payment::create([
                'buyer_name'         => $request->buyer_name,
                'buyer_email'        => $request->buyer_email,
                'transaction_id'     => $request->stripeToken,
                'transaction_detail' => $transactionDetail,
                'gateway'            => 'Stripe',
                'appointment_id'     => $request->token,
                'status'             => 'Pending',
                'updated_at'         => now(),
                'created_at'         => now(),
            ]);

            session()->put('msg', 'payment accepted');
            return response()->json(['status' => true, 'message' => 'Payment Was Successfully', 'url' => route('admin.appointment.index')], 200);
        } catch (Exception $e) {
            // Handle exceptions here
            return response()->json(['status' => false, 'message' => 'Payment failed', 'error' => $e->getMessage()], 500);
        }

    }
}
