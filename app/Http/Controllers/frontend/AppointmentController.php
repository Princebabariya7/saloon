<?php

namespace App\Http\Controllers\frontend;

use App\Http\Requests\frontend\AppointmentAddRequest;
use App\Http\Requests\frontend\AppointmentEditRequest;
use App\Mail\OrderMail;
use App\Models\AppointmentDetail;
use App\Models\AppointmentSlot;
use App\Models\Category;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{

    public function index(Request $request)
    {
        $search      = $request->input('search', '');
        $type        = $request->input('type', '');
        $currentDate = Carbon::now();
//        $AppointmentDetail=AppointmentDetail::all();

        $AppointmentDetail = AppointmentDetail::when($search, function ($query) use ($search)
        {
            return $query->where(function ($query) use ($search)
            {
                $query->orWhereHas('services', function ($query) use ($search)
                {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                });
            });
        })->when($type, function ($query) use ($type)
        {
            return $query->where('type', $type);
        })->where('user_id', '=', auth()->user()->id)->paginate(5);

        return view('frontend.book.onlineorderview')->with('appointments', $AppointmentDetail)
            ->with('currentDate', $currentDate);
    }

    public function create()
    {
        $category  = Category::getList();
        $timeSlots = [];

        return view('frontend.book.order')->with('editMode', false)
            ->with('category', $category)
            ->with('timeSlots', $timeSlots);
    }

    public function store(AppointmentAddRequest $request)
    {
        try
        {
            $appointment = Appointment::create([
                'type'       => $request->type,
                'date'       => Carbon::create($request->date)->format('Y-m-d'),
                'time'       => $request->time,
                'user_id'    => auth()->user()->id,
                'status'     => 'Pending',
                'updated_at' => now(),
                'created_at' => Carbon::now(),
            ]);

            //session()->put('msg', 'your order has been booked');
            //$this->AppointmentConformationMail($appointment);
            session()->put('AppointmentData', $request->all());
            // return redirect(route('online.create'));
            $services = Service::whereIn('id', $request->service_id)->get();
            $total    = $services->sum('price');
            session()->put('totalPrice', $total);

            return redirect(route('payment.page', ['id' => $appointment->id,'total'=>$total]));
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $category        = Category::pluck('type', 'id')->toArray();
        $service         = Service::pluck('name', 'id')->toArray();
        $appointments    = AppointmentDetail::find($id);
        $appointmentSlot = AppointmentSlot::find($appointments->appointment_id);
        $timeSlots       = [];

        return view('frontend.book.order')
            ->with('appointments', $appointments)
            ->with('service_id', $appointments->service_id)
            ->with('category_id', (Service::find($appointments->service_id)->category_id))
            ->with('date', Carbon::create($appointments->appointment->date)->format('m-d-Y'))
            ->with('timeSlot', $appointments->appointment->time)
            ->with('timeSlotid', $appointmentSlot->slot)
            ->with('type', $appointments->appointment->type)
            ->with('editMode', true)
            ->with('category', $category)
            ->with('service', $service)
            ->with('timeSlots', $timeSlots);
    }

    public function update(AppointmentEditRequest $request, $id)
    {

        $appointmentsDetail = AppointmentDetail::find($id);
        $appointments       = Appointment::find($appointmentsDetail->appointment_id);
        $appointmentSlot    = AppointmentSlot::find($appointmentsDetail->appointment_id);

        foreach (request('service_id') as $serviceId)
        {
            $appointmentsDetail->service_id = $serviceId;
            $appointments->type             = $request->input('type');
            $appointments->time             = $request->input('time');
            $appointments->date             = Carbon::create($request->date)->format('Y-m-d');
            $appointmentSlot->date          = Carbon::create($request->date)->format('Y-m-d');
            $appointmentSlot->slot          = $request->input('time');

            $appointmentSlot->update();
            $appointmentsDetail->update();
            $appointments->update();
        }
        session()->put('update', 'your order has been updated');
        return redirect(route('online.index'));
    }

    public function destroy($id)
    {
        try
        {
            $appointmentsDetail = AppointmentDetail::find($id);
            $appointmentsCount  = AppointmentDetail::find($id)->where('appointment_id', '=', $appointmentsDetail->appointment_id);
            if ($appointmentsCount->count() == 1)
            {
                $appointmentSlot = AppointmentSlot::find($appointmentsDetail->appointment_id);
                $appointment     = Appointment::find($appointmentsDetail->appointment_id);
                $appointmentSlot->delete();
                $appointment->delete();
            }
            $appointmentsDetail->delete();

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
        $date  = Carbon::create(\request()->date)->format('Y-m-d');
        $slots = AppointmentSlot::where('date', $date)->pluck('slot', 'slot')->toArray();


        $slotList = $this->slotList();
        $slotDay  = (Carbon::create(\request()->date)->dayName);
        return response()->json(
            [
                'slotHtml' => view('frontend.book.fetchslot')
                    ->with('slotDay', $slotDay)
                    ->with('slots', $slots)
                    ->with('timeSlots', $slotList)->render(),
            ], 200);
    }

    public function slotList()
    {
        return [
            '9:00 AM - 10:00 AM'  => '9:00 AM - 10:00 AM',
            '10:00 AM - 11:00 AM' => '10:00 AM - 11:00 AM',
            '11:00 AM - 12:00 PM' => '11:00 AM - 12:00 PM',
            '12:00 PM - 1:00 PM'  => '12:00 PM - 1:00 PM',
            '1:00 PM - 2:00 PM'   => '1:00 PM - 2:00 PM',
            '2:00 PM - 3:00 PM'   => '2:00 PM - 3:00 PM',
            '3:00 PM - 4:00 PM'   => '3:00 PM - 4:00 PM',
            '4:00 PM - 5:00 PM'   => '4:00 PM - 5:00 PM',
            '5:00 PM - 6:00 PM'   => '5:00 PM - 6:00 PM',
            '6:00 PM - 7:00 PM'   => '6:00 PM - 7:00 PM',
            '7:00 PM - 8:00 PM'   => '7:00 PM - 8:00 PM',
            '8:00 PM - 9:00 PM'   => '8:00 PM - 9:00 PM',
        ];
    }

    public function AppointmentConformationMail($appointment)
    {
        Mail::to(auth()->user()->email)->send(new OrderMail($appointment));
    }
}
