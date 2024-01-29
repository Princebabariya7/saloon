<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\AppointmentStoreRequest;
use App\Http\Requests\Backend\AppointmentUpdateRequest;
use App\Models\Category;
use App\Models\Appointment;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $category = Category::getList();
        return view('Backend.appointment.appointment_form')->with('editMode', false)
            ->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'])
            ->with('category', $category);
    }

//    public function store(AppointmentStoreRequest $request)
//    {
//        foreach (request('service_id') as $serviceId)
//        {
//            Appointment::create([
//                'service_id' => $serviceId,
//                'type'       => $request->type,
//                'date'       => Carbon::create($request->date)->format('Y-m-d'),
//                'time'       => $request->time,
//                'user_id'    => auth()->user()->id,
//                'status'     => $request->status,
//                'updated_at' => now(),
//                'created_at' => Carbon::now(),
//            ]);
//        }
//
//        session()->put('add', 'data add');
//        return redirect(route('admin.appointment.index'));
//
//    }
    public function store(AppointmentStoreRequest $request)
    {
        foreach (request('service_id') as $serviceId)
        {
            // Extract start time from the time range string
            $timeRange = explode(' - ', $request->time);
            $startTime = Carbon::createFromFormat('h:i A', $timeRange[0])->format('H:i:s');

            Appointment::create([
                'service_id' => $serviceId,
                'type'       => $request->type,
                'date'       => Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d'),
                'time'       => $startTime,
                'user_id'    => auth()->user()->id,
                'status'     => $request->status,
                'updated_at' => now(),
                'created_at' => now(),
            ]);
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
        $category    = Category::pluck('type', 'id')->toArray();
        $service     = Service::pluck('name', 'id')->toArray();
        $appointment = Appointment::find($id);

        return view('Backend.appointment.appointment_form')
            ->with('appointment', $appointment)
            ->with('service_id', $appointment->service_id)
            ->with('category_id', (Service::find($appointment->service_id)->category_id))
            ->with('type', $appointment->type)
            ->with('date', Carbon::create($appointment->date)->format('Y-m-d'))
            ->with('time', $appointment->time)
            ->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'])
            ->with('editMode', true)
            ->with('category', $category)
            ->with('service', $service);
    }

    public function update(AppointmentUpdateRequest $request, $id)
    {
        $appointment = Appointment::find($id);

        foreach (request('service_id') as $serviceId)
        {
            $dateTime                = Carbon::create($request->date)->format('Y-m-d');
            $appointment->service_id = $serviceId;
            $appointment->type       = $request->input('type');
            $appointment->date       = $dateTime;
            $appointment->status     = $request->input('status');
        }
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
}
