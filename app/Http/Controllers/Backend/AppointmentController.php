<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\AppointmentStoreRequest;
use App\Http\Requests\Backend\AppointmentUpdateRequest;
use App\Models\Appointment;
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
                $query->orWhere('mobile', 'LIKE', '%' . $search . '%')
                    ->orWhere('customer_name', 'LIKE', '%' . $search . '%');
            });
        })->when($status, function ($query) use ($status)
        {
            return $query->where('status', $status);
        })->sortable(['service' => 'asc'])->paginate(5);
        return view('Backend.appointment.index')->with('appointments', $appointments);
    }

    public function create()
    {
        return view('Backend.appointment.appointment_form')->with('editMode', false)->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive']);
    }

    public function store(AppointmentStoreRequest $request)
    {
        Appointment::create([
            'customer_name' => $request->customer_name,
            'mobile'        => $request->mobile,
            'stylist'       => $request->stylist,
            'service'       => $request->service,
            'date_time'     => Carbon::create($request->date_time)->format('Y-m-d H:i:s'),
            'status'        => $request->status
        ]);
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
        $appointment = Appointment::find($id);

        return view('Backend.appointment.appointment_form')
            ->with('appointment', $appointment)
            ->with('date_time', Carbon::create($appointment->date_time)->format('m-d-y H:i:s'))
            ->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'])
            ->with('editMode', true);
    }

    public function update(AppointmentUpdateRequest $request, $id)
    {
        $dateTime                   = Carbon::create($request->date_time)->format('Y-m-d H:i:s');
        $appointment                = Appointment::find($id);
        $appointment->customer_name = $request->input('customer_name');
        $appointment->mobile        = $request->input('mobile');
        $appointment->stylist       = $request->input('stylist');
        $appointment->service       = $request->input('service');
        $appointment->date_time     = $dateTime;
        $appointment->status        = $request->input('status');
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
}
