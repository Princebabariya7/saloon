<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('Backend.order.index');

    }

    public function create()
    {
//        return view('order.order_detail');

    }

    public function store(Request $request)
    {

        $dateTime = Carbon::createFromFormat('m/d/Y h:i A', $request->date_time);

        Order::create([
            'date_time'     => $dateTime->format('Y-m-d H:i:s'),
            'customer_name' => $request->customer_name,
            'address'       => $request->address,
            'service'       => $request->service,
            'mode'          => $request->mode,
            'amount'        => $request->amount,
            'status'        => $request->status,
            'updated_at'    => now(),
            'created_at'    => now(),
        ]);

        return view('admin.order.index');
//        return redirect(route('appointment.view'));

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
