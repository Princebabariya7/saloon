<?php

namespace App\Http\Controllers\Backend;


use App\Http\Requests\Backend\PaymentStoreRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

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


    public function create()
    {
        return view('Backend.payment.payment_form');
    }

    public function store(PaymentStoreRequest $request)
    {
        Payment::create([
            'buyer_name'    => $request->buyer_name,
            'buyer_email'   => $request->buyer_email,
            'buyer_address' => $request->buyer_address,
            'cd_number'     => $request->cd_number,
            'exp_month'     => $request->exp_month,
            'exp_year'      => $request->exp_year,
            'cvv'           => $request->cvv,
            'updated_at'    => now(),
            'created_at'    => now(),
        ]);

        session()->put('msg', 'payment accepted');
        return redirect(route('admin.appointment.index'));
    }
}
