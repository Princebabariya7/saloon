<?php

namespace App\Http\Controllers\frontend;

use App\Http\Requests\frontend\AppointmentAddRequest;
use App\Http\Requests\frontend\AppointmentEditRequest;
use App\Models\AppointmentSlot;
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
        $type   = $request->input('type', '');

        $orders = Appointment::with('services')
            ->when($search, function ($query) use ($search)
            {
                return $query->where(function ($query) use ($search)
                {
                    $query->orWhereHas('services', function ($query) use ($search)
                    {
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    });
                });
            })
            ->when($type, function ($query) use ($type)
            {
                return $query->where('type', $type);
            })
            ->where('user_id', '=', auth()->user()->id)
            ->paginate(5);

        return view('frontend.book.onlineorderview')->with('ord ers', $orders);
    }

    public function create()
    {
        $category  = Category::getList();
        $timeSlots = [
            '9_to_10'  => '9:00 AM - 10:00 AM',
            '10_to_11' => '10:00 AM - 11:00 AM',
            '11_to_12' => '11:00 AM - 12:00 PM',
            '12_to_1'  => '12:00 PM - 1:00 PM',
            '1_to_2'   => '1:00 PM - 2:00 PM',
            '2_to_3'   => '2:00 PM - 3:00 PM',
            '3_to_4'   => '3:00 PM - 4:00 PM',
            '4_to_5'   => '4:00 PM - 5:00 PM',
            '5_to_6'   => '5:00 PM - 6:00 PM',
            '6_to_7'   => '6:00 PM - 7:00 PM',
            '7_to_8'   => '7:00 PM - 8:00 PM',
            '8_to_9'   => '8:00 PM - 9:00 PM',
        ];

        return view('frontend.book.order')->with('editMode', false)
            ->with('category', $category)
            ->with('timeSlots', $timeSlots);
    }

    public function store(AppointmentAddRequest $request)
    {

        try
        {
            foreach (request('service_id') as $serviceId)
            {
               $appointment= Appointment::create([
                    'service_id' => $serviceId,
                    'type'       => $request->type,
                    'date'       => Carbon::create($request->date)->format('Y-m-d'),
                    'time'       => $request->time,
                    'user_id'    => auth()->user()->id,
                    'status'     => 'Active',
                    'updated_at' => now(),
                    'created_at' => Carbon::now(),
                ]);

            $input =[
                'date'=> $appointment->date,
                'slot'=> $request->time_slot,
                'appointment_id'=>$appointment->id
            ];

            AppointmentSlot::create($input);
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
            ->with('date', Carbon::create($orders->date)->format('m-d-Y'))
            ->with('timeSlot', $orders->time)
            ->with('editMode', true)
            ->with('category', $category)
            ->with('service', $service);
    }

    public function update(AppointmentEditRequest $request, $id)
    {
        $orders = Appointment::find($id);

        foreach (request('service_id') as $serviceId)
        {
            $orders->service_id = $serviceId;
            $orders->type       = $request->input('type');
            $orders->time       = $request->input('time');
            $orders->date       = Carbon::create($request->date)->format('Y-m-d');
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
    public function timeSlot()
    {
       $date=  Carbon::create(\request()->date)->format('Y-m-d');
        $slot = AppointmentSlot::where('date', $date)->pluck('slot', 'id')->toArray();
        dd($slot);
    }
}
