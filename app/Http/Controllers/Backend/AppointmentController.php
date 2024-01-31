<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\AppointmentStoreRequest;
use App\Http\Requests\Backend\AppointmentUpdateRequest;
use App\Models\AppointmentSlot;
use App\Models\Category;
use App\Models\Appointment;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $search       = $request->input('search', '');
        $status       = $request->input('status', '');
        $appointments = Appointment::when($search, function ($query) use ($search)
        {
            return $query->where(function ($query) use ($search)
            {
                $query->orWhere('type', 'LIKE', '%' . $search . '%');
            });
        })->when($status, function ($query) use ($status)
        {
            return $query->where('status', $status);
        })->sortable(['service' => 'asc'])->paginate(5);
        return view('Backend.appointment.index')->with('appointments', $appointments);
    }

    public function create()
    {
        $category  = Category::getList();
        $timeSlots = [];
        return view('Backend.appointment.appointment_form')->with('editMode', false)
            ->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'])
            ->with('category', $category)
            ->with('timeSlots', $timeSlots);
    }

    public function store(AppointmentStoreRequest $request)
    {
        foreach (request('service_id') as $serviceId)
        {
            $appointment = Appointment::create([
                'service_id' => $serviceId,
                'type'       => $request->type,
                'date'       => Carbon::create($request->date)->format('Y-m-d'),
                'time'       => $request->time,
                'user_id'    => auth()->user()->id,
                'status'     => $request->status,
                'updated_at' => now(),
                'created_at' => Carbon::now(),
            ]);

            $input = [

                'date'           => $appointment->date,
                'slot'           => $request->time_slot,
                'appointment_id' => $appointment->id
            ];

            AppointmentSlot::create($input);

        }


        session()->put('add', 'data add');
        return redirect(route('admin.appointment.index'));

    }

    public function show($id)
    {
        $appointment = Appointment::find($id);
        return view('Backend.appointment.show', ['appointment' => $appointment]);
    }

    public function edit($id)
    {
        $category        = Category::getList();
        $appointment     = Appointment::find($id);
        $appointmentSlot = AppointmentSlot::find($id);
        $timeSlots       = [];


        return view('Backend.appointment.appointment_form')
            ->with('appointment', $appointment)
            ->with('service_id', $appointment->service_id)
            ->with('category_id', (Service::find($appointment->service_id)->category_id))
            ->with('type', $appointment->type)
            ->with('date', Carbon::create($appointment->date)->format('m-d-Y'))
            ->with('timeSlot', $appointment->time)
            ->with('timeSlotid', $appointmentSlot->slot)
            ->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'])
            ->with('editMode', true)
            ->with('category', $category)
            ->with('timeSlots', $timeSlots);

    }

    public function update(AppointmentUpdateRequest $request, $id)
    {
        $appointment     = Appointment::find($id);
        $appointmentSlot = AppointmentSlot::find($id);

        $dateTime              = Carbon::create($request->date)->format('Y-m-d');
        $appointment->type     = $request->input('type');
        $appointment->time     = $request->input('time');
        $appointment->date     = $dateTime;
        $appointment->status   = $request->input('status');
        $appointmentSlot->date = $dateTime;
        $appointmentSlot->slot = $request->input('time_slot');

        $appointmentSlot->update();
        $appointment->update();
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
        $date     = \Illuminate\Support\Carbon::create(\request()->date)->format('Y-m-d');
        $slots    = AppointmentSlot::where('date', $date)->pluck('slot', 'id')->toArray();
        $slotList = $this->slotList();
        foreach ($slots as $slot)
        {
            if (isset($slotList[$slot]))
            {
                unset($slotList[$slot]);
            }
        }
        return response()->json(
            [
                'slotHtml' => view('Backend.appointment.fetch_timeslot')->with('timeSlots', $slotList)->render(),
            ], 200);

    }

    public function slotList()
    {
        return [
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
    }
}
