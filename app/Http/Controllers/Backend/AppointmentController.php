<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\AppointmentStoreRequest;
use App\Http\Requests\Backend\AppointmentUpdateRequest;
use App\Models\AppointmentDetail;
use App\Models\AppointmentSlot;
use App\Models\Category;
use App\Models\Appointment;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $search      = $request->input('search', '');
        $status      = $request->input('status', '');
        $type        = $request->input('type', '');
        $dateRange   = $request->input('anotherInput', '');
        $currentDate = Carbon::now();
        $direction   = $request->input('direction', 'asc');
        if (!in_array($direction, ['asc', 'desc']))
        {
            $direction = 'asc';
        }

        $query = Appointment::with('details')
            ->select(
                'appointment_detail.id',
                'appointments.date',
                'appointments.time',
                'users.firstname',
                'users.lastname',
                'categories.type as category',
                'services.name',
                'appointments.type',
                'appointments.status',
                'appointments.created_at'
            )
            ->leftJoin('users', 'users.id', '=', 'appointments.user_id')
            ->leftJoin('appointment_detail', 'appointments.id', '=', 'appointment_detail.appointment_id')
            ->leftJoin('services', 'services.id', '=', 'appointment_detail.service_id')
            ->leftJoin('categories', 'categories.id', '=', 'services.category_id')
            ->search($search)
            ->statusType($status, $type);

        // Check if $request->sort is set and not empty before applying orderBy
        if ($request->has('sort') && $request->sort != '')
        {
            $query->orderBy($request->sort, $direction);
        }

        // Add this condition to filter by date range
        if ($dateRange)
        {
            $dateRange = explode(' - ', $dateRange);
            $startDate = Carbon::createFromFormat('m/d/Y', $dateRange[0])->startOfDay();
            $endDate   = Carbon::createFromFormat('m/d/Y', $dateRange[1])->endOfDay();
            $query->whereBetween('appointments.date', [$startDate, $endDate]);
        }

        if ($type)
        {
            $query->where('appointments.type', $type);
        }
        $appointmentDetail = $query->paginate(10);

        return view('Backend.appointment.index')
            ->with('appointments', $appointmentDetail)
            ->with('currentDate', $currentDate);
    }

    public function create()
    {
        $category  = Category::getList();
        $timeSlots = [];
        return view('Backend.appointment.form')
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
            session()->put('AppointmentData', $request->all());
            $services = Service::whereIn('id', $request->service_id)->get();
            $total    = $services->sum('price');
            session()->put('totalPrice', $total);
            session()->put('add', 'data add');
            return view('Backend.Payment.form')
                ->with('id', $appointment->id)
                ->with('total', $total)
                ->with('buyer_name', auth()->user()->firstname)
                ->with('buyer_email', auth()->user()->email);
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $currentDate = Carbon::now();
        $appointment = AppointmentDetail::find($id);
        return view('Backend.appointment.show', ['appointment' => $appointment])->with('currentDate', $currentDate);
    }

    public function edit($id)
    {
        $category        = Category::getList();
        $appointment     = AppointmentDetail::find($id);
        $appointmentSlot = AppointmentSlot::find($appointment->appointment_id);
        $timeSlots       = [];

        return view('Backend.appointment.form')
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
        $appointmentsDetail = AppointmentDetail::find($id);
        $appointment        = Appointment::find($appointmentsDetail->appointment_id);
        $appointmentSlot    = AppointmentSlot::find($appointmentsDetail->appointment_id);

        foreach (request('service_id') as $serviceId)
        {
            $appointmentsDetail->service_id = $serviceId;
            $dateTime                       = Carbon::create($request->date)->format('Y-m-d');
            $appointment->type              = $request->input('type');
            $appointment->time              = $request->input('time');
            $appointment->date              = $dateTime;
            $appointment->status            = $request->input('status');
            $appointmentSlot->date          = $dateTime;
            $appointmentSlot->slot          = $request->input('time');

            $appointmentSlot->update();
            $appointment->update();
            $appointmentsDetail->update();
        }

        session()->put('update', 'data update');
        return redirect(route('admin.appointment.index'));
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
}
