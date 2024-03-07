<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\PaymentRequest;
use App\Models\AppointmentDetail;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Routing\Controller;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function index()
    {
        //
    }

    public function store(PaymentRequest $request)
    {
        try
        {
            Stripe::setApiKey(config('services.stripe.secret'));
//            $total  = session()->get('totalPrice');
            $intent = PaymentIntent::create([
                'amount'               => $request->total * 100,
                'currency'             => 'usd',
                'payment_method_types' => ['card'],
                'payment_method_data'  => ['type' => 'card', 'card' => ['token' => $request->stripeToken]]
            ]);
            $intent->confirm();
            if ($intent->status === 'requires_action' || $intent->status === 'requires_source_action')
            {
                $intentResponse = response()->json([
                    'status'            => 'requires_action',
                    'payment_intent_id' => $intent->id,
                    //'client_secret'     => $intent->client_secret,
                    'message'           => 'Payment requires additional action',
                ]);
            }
            elseif ($intent->status === 'succeeded')
            {
                // Payment was successful
                $intentResponse = response()->json([
                    'status'            => 'success',
                    'payment_intent_id' => $intent->id,
                    'message'           => 'Payment successful',
                ]);
            }
            else
            {
                // Handle other possible status values
                $intentResponse = response()->json([
                    'status'  => 'error',
                    'message' => 'Payment failed',
                    'details' => $intent->last_payment_error ? $intent->last_payment_error->message : '',
                ], 500);
            }
            $transactionDetail = json_encode(['status' => true, 'message' => 'Payment Was Successfully', 'total' => $request->total]);
            $statusData        = json_decode($transactionDetail, true); // Decode the JSON string to an associative array
            $status            = $statusData['status'] ? 'Success' : 'Pending';
            Payment::create([
                'transaction_id'     => $request->stripeToken,
                'transaction_detail' => json_encode($intentResponse),
                'total'              => $request->total,
                'gateway'            => 'Stripe',
                'appointment_id'     => $request->token,
                'status'             => $status,
                'updated_at'         => now(),
                'created_at'         => now(),
            ]);
            session()->put('msg', 'payment accepted');
            return response()->json(['status' => true, 'message' => 'Payment Was Successfully', 'url' => route('online.index')], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'Payment failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function create($token)
    {
        return view('Frontend.payment.index')->with('token', $token)->with('buyer_name', auth()->user()->firstname)->with('buyer_email', auth()->user()->email);
    }

    public function pending($token)
    {
        $appointmentId     = AppointmentDetail::find($token);
        $appointmentDetail = AppointmentDetail::where('appointment_id', AppointmentDetail::find($token)->appointment_id)->get();
        $servicesIds       = $appointmentDetail->pluck('service_id')->toArray();
        $services          = Service::whereIn('id', $servicesIds)->get();
        $total             = $services->sum('price');

        return redirect(route('payment.page', ['id' => $appointmentId->appointment_id, 'total' => $total]));
    }

}
