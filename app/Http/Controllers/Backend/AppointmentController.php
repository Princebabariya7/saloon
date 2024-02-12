<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\AppointmentStoreRequest;
use App\Http\Requests\Backend\AppointmentUpdateRequest;
use App\Http\Requests\Backend\PaymentStoreRequest;
use App\Mail\OrderMail;
use App\Models\AppointmentDetail;
use App\Models\AppointmentSlot;
use App\Models\Category;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $search      = $request->input('search', '');
        $status      = $request->input('status', '');
        $currentDate = Carbon::now();
//        $AppointmentDetail = AppointmentDetail::all();
        $AppointmentDetail = AppointmentDetail::when($search, function ($query) use ($search)
        {
            return $query->where(function ($query) use ($search)
            {
                $query->orWhereHas('services', function ($query) use ($search)
                {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                });
            });
        })->when($status, function ($query) use ($status)
        {
            return $query->where('status', $status);
        })->paginate(5);
        return view('Backend.appointment.index')->with('appointments', $AppointmentDetail)->with('currentDate', $currentDate);
    }

    public function create()
    {
        $category  = Category::getList();
        $timeSlots = [];
        return view('Backend.appointment.appointment_form')
            ->with('status', ['' => 'Select one', 'Pending' => 'Pending', 'Success' => 'Success', 'Cancel' => 'Cancel'])
            ->with('category', $category)
            ->with('editMode', false)
            ->with('timeSlots', $timeSlots);
    }

    public function store(AppointmentStoreRequest $request)
    {
        session()->put('AppointmentData', $request->all());
        try
        {
            $appointment = Appointment::create([
                'type'       => $request->type,
                'date'       => Carbon::create($request->date)->format('Y-m-d'),
                'time'       => $request->time,
                'user_id'    => auth()->user()->id,
                'status'     => $request->status,
                'updated_at' => now(),
                'created_at' => Carbon::now(),
            ]);

            session()->put('add', 'data add');
//        $this->AppointmentConformationMail($appointment);
//        return redirect(route('admin.appointment.index'));
            return redirect(route('admin.payment.create'));
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }


    }

    public function show($id)
    {
        $appointment = AppointmentDetail::find($id);
        return view('Backend.appointment.show', ['appointment' => $appointment]);
    }

    public function edit($id)
    {
        $category        = Category::getList();
        $appointment     = AppointmentDetail::find($id);
        $appointmentSlot = AppointmentSlot::find($appointment->appointment_id);
        $timeSlots       = [];

        return view('Backend.appointment.appointment_form')
            ->with('appointment', $appointment)
            ->with('service_id', $appointment->service_id)
            ->with('category_id', (Service::find($appointment->service_id)->category_id))
            ->with('type', $appointment->appointment->type)
            ->with('date', Carbon::create($appointment->appointment->date)->format('m-d-Y'))
            ->with('timeSlot', $appointment->appointment->time)
            ->with('timeSlotid', $appointmentSlot->slot)
            ->with('status', ['' => 'Select one', 'Pending' => 'Pending', 'Success' => 'Success', 'Cancel' => 'Cancel'])
            ->with('editMode', true)
            ->with('category', $category)
            ->with('timeSlots', $timeSlots);

    }

    public function update(AppointmentUpdateRequest $request, $id)
    {
        $appointment     = Appointment::find($id);
        $appointmentSlot = AppointmentSlot::find($id);

        foreach (request('service_id') as $serviceId)
        {
            $appointment->service_id = $serviceId;
            $dateTime                = Carbon::create($request->date)->format('Y-m-d');
            $appointment->type       = $request->input('type');
            $appointment->time       = $request->input('time');
            $appointment->date       = $dateTime;
            $appointment->status     = $request->input('status');
            $appointmentSlot->date   = $dateTime;
            $appointmentSlot->slot   = $request->input('time');

            $appointmentSlot->update();
            $appointment->update();
        }

        session()->put('update', 'data update');
        return redirect(route('admin.appointment.index'));
    }

    public function destroy($id)
    {
        try
        {
            $appointment = Appointment::find($id);

            if ($appointment)
            {
                $appointmentSlot = AppointmentSlot::find($id);

                if ($appointmentSlot)
                {
                    $appointmentSlot->delete();
                }

                $appointment->delete();
            }

            return response()->json(['status' => true, 'message' => 'Record deleted successfully'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'Record was not deleted'], 400);
        }
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
        $date     = Carbon::create(\request()->date)->format('Y-m-d');
        $slots    = AppointmentSlot::where('date', $date)->pluck('slot', 'slot')->toArray();
        $slotList = $this->slotList();
        $slotDay  = (Carbon::create(\request()->date)->dayName);
        return response()->json(
            [
                'slotHtml' => view('Backend.appointment.fetch_timeslot')
                    ->with('slotDay', $slotDay)
                    ->with('slots', $slots)
                    ->with('timeSlots', $slotList)
                    ->render(),
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
