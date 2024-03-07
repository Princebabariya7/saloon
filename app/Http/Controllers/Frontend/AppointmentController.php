<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\AppointmentAddRequest;
use App\Http\Requests\Frontend\AppointmentEditRequest;
use App\Models\AppointmentDetail;
use App\Models\AppointmentSlot;
use App\Models\Category;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\SettingsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $search      = $request->input('search', '');
        $status      = $request->input('status', '');
        $type        = $request->input('type', '');
        $dateRange   = $request->input('anotherInput', '');
        $currentDate = \Carbon\Carbon::now();
        $direction   = $request->input('direction', 'asc');
        if (!in_array($direction, ['asc', 'desc']))
        {
            $direction = 'asc';
        }
        $user = auth()->user()->id;

        $query = Appointment::with('details')
            ->select(
                'appointments.date',
                'appointments.time',
                'users.firstname',
                'users.lastname',
                'categories.type as category',
                'services.name',
                'appointments.type',
                'appointments.status',
                'appointments.created_at',
                'appointment_detail.id'
            )
            ->leftJoin('users', 'users.id', '=', 'appointments.user_id')
            ->leftJoin('appointment_detail', 'appointments.id', '=', 'appointment_detail.appointment_id')
            ->leftJoin('services', 'services.id', '=', 'appointment_detail.service_id')
            ->leftJoin('categories', 'categories.id', '=', 'services.category_id')
            ->search($search)
            ->statusType($status, $type)
            ->where('appointments.user_id', '=', $user);

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
        $AppointmentDetail = $query->paginate(5);

        return view('Frontend.book.view')->with('appointments', $AppointmentDetail)
            ->with('currentDate', $currentDate);
    }

    public function create()
    {
        $category  = Category::getList();
        $timeSlots = [];

        return view('Frontend.book.order')->with('editMode', false)
            ->with('category', $category)
            ->with('timeSlots', $timeSlots);
    }

    public function store(AppointmentAddRequest $request)
    {
        try
        {
            session()->put('AppointmentData', $request->all());
            $appointment = Appointment::create([
                'type'       => $request->type,
                'date'       => Carbon::create($request->date)->format('Y-m-d'),
                'time'       => $request->time,
                'user_id'    => auth()->user()->id,
                'status'     => 'Pending',
                'updated_at' => now(),
                'created_at' => Carbon::now(),
            ]);
            $services    = Service::whereIn('id', $request->service_id)->get();
            $total       = $services->sum('price');
            session()->put('totalPrice', $total);
            return redirect(route('payment.page', ['id' => $appointment->id, 'total' => $total]));
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

        return view('Frontend.book.order')
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
        return view('Frontend.book.order');
    }

    public function orderlist()
    {
        return view('Frontend.order.orderlist');
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
                'slotHtml' => view('Frontend.book.fetchslot')
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

    public function setLocale(Request $request)
    {
        $locale = $request->input('locale', 'en');
        App::setLocale($locale);

        $existingSetting = SettingsModel::where('setting_key', 'language')->first();

        if ($existingSetting)
        {
            $existingSetting->update(['setting_value' => $locale]);
        }
        else
        {
            SettingsModel::create([
                'setting_key'   => 'language',
                'setting_value' => $locale,
            ]);
        }

        return response()->json(['success' => true]);
    }
}
