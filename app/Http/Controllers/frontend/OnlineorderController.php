<?php

namespace App\Http\Controllers\frontend;

use App\Http\Requests\frontend\OnlineorderEditRequest;
use App\Http\Requests\frontend\OnlineorderRequest;
use App\Models\Onlineorder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OnlineorderController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search', '');
        $city   = $request->input('city', '');


        $orders = Onlineorder::when($search, function ($query) use ($search)
        {
            return $query->where(function ($query) use ($search)
            {
                $query->orwhere('package', 'LIKE', '%' . $search . '%')
                    ->orWhere('city', 'LIKE', '%' . $search . '%');
            });
        })->when($city, function ($query) use ($city)
        {
            return
                $query->where('city', $city);
        })->paginate(5);

        return view('frontend.book.onlineorderview')->with('orders', $orders);
    }

    public function create()
    {
        return view('frontend.book.order')->with('editMode', false);
    }

    public function store(OnlineorderRequest $request)
    {
        try
        {
            Onlineorder::create([
                'package'          => $this->customImplode($request->package),
                'categories'       => $this->customImplode($request->categories),
                'service'          => $this->customImplode($request->service),
                'address'          => $request->address,
                'city'             => $request->city,
                'state'            => $request->state,
                'zipcode'          => $request->zipcode,
                'appointment_time' => Carbon::createFromFormat('m/d/Y g:i A', $request->appointment_time)->format('Y-m-d H:i:s'),
                'updated_at'       => now(),
                'created_at'       => Carbon::now(),
            ]);

            session()->put('msg', 'your order has been booked');
            return redirect(route('online.create'));
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function customImplode($value)
    {
        return (!empty($value)) ? implode(',', $value) : '';
    }

    public function edit($id)
    {
        $online = Onlineorder::find($id);
        return view('frontend.book.order')
            ->with('online', $online)
            ->with('package', explode(',', $online->package))
            ->with('categories', explode(',', $online->categories))
            ->with('service', explode(',', $online->service))
            ->with('appointment_time', (Carbon::create($online->appointment_time)->format('m-d-y H:i:s')))
            ->with('editMode', true);
    }

    public function update(OnlineorderEditRequest $request, $id)
    {
        $online                   = Onlineorder::find($id);
        $online->package          = $this->customImplode($request->package);
        $online->categories       = $this->customImplode($request->categories);
        $online->service          = $this->customImplode($request->service);
        $online->address          = $request->input('address');
        $online->city             = $request->input('city');
        $online->state            = $request->input('state');
        $online->zipcode          = $request->input('zipcode');
        $online->appointment_time = Carbon::create($request->appointment_time)->format('Y-m-d H:i:s');
        $online->update();
        session()->put('update', 'your order has been updated');
        return redirect(route('online.index'));
    }

    public function destroy($id)
    {
        try
        {
            $online = Onlineorder::find($id);
            if ($online)
            {
                $online->delete();
            }
            return response()->json(['status' => true, 'message' => 'Record deleted successfully'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'Record was not deleted'], 400);
        }
    }

    public function view()
    {
        return view('frontend.book.order');
    }

    public function orderlist()
    {
        return view('frontend.order.orderlist');
    }
}
