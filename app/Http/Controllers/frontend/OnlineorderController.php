<?php

namespace App\Http\Controllers\frontend;

use App\Http\Requests\frontend\OnlineorderEditRequest;
use App\Http\Requests\frontend\OnlineorderRequest;
use App\Models\Onlineorders;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OnlineorderController extends Controller
{
    public function index(Request $request)
    {

        $search  = $request->input('search', '');
        $service = $request->input('service', '');


        $orders = Onlineorders::with('services')->when($search, function ($query) use ($search)
        {
            return $query->where(function ($query) use ($search)
            {
                $query->orWhere('service', 'LIKE', '%' . $search . '%')->orWhere('categories', 'LIKE', '%' . $search . '%');
            });
        })->when($service, function ($query) use ($service)
        {
            return
                $query->where('service', $service);
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
            Onlineorders::create([
                'categories' => $this->customImplode($request->categories),
                'service'    => $this->customImplode($request->service),
                'type'       => $request->type == 'appointment' ? 'appointment' : 'order',
                'date'       => Carbon::createFromFormat('m/d/Y g:i A', $request->date)->format('Y-m-d H:i:s'),
                'user_id'    => auth()->user()->id,
                'status'     => 'Active',
                'updated_at' => now(),
                'created_at' => Carbon::now(),
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
        $online = Onlineorders::find($id);

        return view('frontend.book.order')
            ->with('online', $online)
            ->with('categories', explode(',', $online->categories))
            ->with('service', explode(',', $online->service))
            ->with('date', (Carbon::create($online->appointment_time)->format('m-d-y H:i:s')))
            ->with('editMode', true);
    }

    public function update(OnlineorderEditRequest $request, $id)
    {
        $online             = Onlineorders::find($id);
        $online->categories = $this->customImplode($request->categories);
        $online->service    = $this->customImplode($request->service);
        $online->type       = $request->input('type');
        $online->date       = Carbon::create($request->date)->format('Y-m-d H:i:s');
        $online->update();
        session()->put('update', 'your order has been updated');
        return redirect(route('online.index'));
    }

    public function destroy($id)
    {
        try
        {
            $online = Onlineorders::find($id);
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
