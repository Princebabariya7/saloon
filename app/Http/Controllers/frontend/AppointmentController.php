<?php

namespace App\Http\Controllers\frontend;

use App\Http\Requests\frontend\OnlineorderEditRequest;
use App\Http\Requests\frontend\OnlineorderRequest;
use App\Models\Category;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AppointmentController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $type = $request->input('type', '');

        $orders = Appointment::with('services')
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($query) use ($search) {
                    $query->orWhereHas('services', function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    });
                });
            })
            ->when($type, function ($query) use ($type) {
                return $query->where('type', $type);
            })
            ->where('user_id', '=', auth()->user()->id)
            ->paginate(5);

        return view('frontend.book.onlineorderview')->with('orders', $orders);
    }

    public function create()
    {
        $category = Category::getList();
        return view('frontend.book.order')->with('editMode', false)
            ->with('category', $category);
    }

    public function store(OnlineorderRequest $request)
    {
        try
        {
            foreach (request('service_id') as $serviceId)
            {
                Appointment::create([
                    'service_id' => $serviceId,
                    'type'       => $request->type,
                    'date'       => Carbon::createFromFormat('m/d/Y g:i A', $request->date)->format('Y-m-d H:i:s'),
                    'user_id'    => auth()->user()->id,
                    'status'     => 'Active',
                    'updated_at' => now(),
                    'created_at' => Carbon::now(),
                ]);
            }


            session()->put('msg', 'your order has been booked');
            return redirect(route('online.create'));
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $category = Category::pluck('type', 'id')->toArray();
        $service  = Service::pluck('name', 'id')->toArray();
        $orders   = Appointment::find($id);
        return view('frontend.book.order')
            ->with('orders', $orders)
            ->with('service_id', $orders->service_id)
            ->with('category_id', (Service::find($orders->service_id)->category_id))
            ->with('date', Carbon::create($orders->date)->format('m-d-y H:i:s'))
            ->with('editMode', true)
            ->with('category', $category)
            ->with('service', $service);
    }

    public function update(OnlineorderEditRequest $request, $id)
    {
        $orders = Appointment::find($id);

        foreach (request('service_id') as $serviceId)
        {
            $orders->service_id = $serviceId;
            $orders->type       = $request->input('type');
            $orders->date       = Carbon::create($request->date)->format('Y-m-d H:i:s');
        }

        $orders->update();
        session()->put('update', 'your order has been updated');
        return redirect(route('online.index'));
    }

    public function destroy($id)
    {
        try
        {
            $orders = Appointment::find($id);
            if ($orders)
            {
                $orders->delete();
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

    public function fetchServices()
    {
        try
        {

            $service = [];

            if (request('id'))
            {
                $service = Service::where('category_id', request('id'))->pluck('name', 'id')->toArray();
            }
            return response()->json(
                [
                    'status'   => true,
                    'services' => $service,
                    'message'  => ''
                ], 200);


        }
        catch (\Exception $e)
        {
            return response()->json(
                [
                    'status'  => false,
                    'message' => $e->getMessage()
                ], 400);
        }
    }
}
