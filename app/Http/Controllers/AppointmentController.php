<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentAddRequest;
use App\Http\Requests\AppointmentEditRequest;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('book.appointmentview')->with('data', Appointment::paginate(5));
    }

    public function create()
    {
        return view('book.appointment')->with('editMode', false);
    }

    public function store(AppointmentAddRequest $request)
    {

        $carbonDateTime = Carbon::createFromFormat('m/d/Y g:i A', $request->appointment_time);
        $str1           = implode(',', $request->package);
        Appointment::create([
            'package'          => $str1,
            'stylist'          => $request->stylist,
            'appointment_time' => $carbonDateTime->format('Y-m-d H:i:s'),
            'updated_at'       => now(),
            'created_at'       => Carbon::now(),
        ]);
        return redirect(route('appointment.create'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $appointment = Appointment::find($id);
        $dateTime    = Carbon::create($appointment->appointment_time)->format('m-d-y H:i:s');
        return view('book.appointment')
            ->with('appointment', $appointment)
            ->with('package', explode(',', $appointment->package))
            ->with('appointment_time', ($dateTime))
            ->with('editMode', true);
    }

    public function update(AppointmentEditRequest $request, $id)
    {
        $str1                          = implode(',', $request->package);
        $dateTime                      = Carbon::create($request->appointment_time)->format('Y-m-d H:i:s');
        $appointment                   = Appointment::find($id);
        $appointment->package          = $str1;
        $appointment->stylist          = $request->input('stylist');
        $appointment->appointment_time = $dateTime;
        $appointment->update();
        return redirect(route('appointment.index'));
    }

    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment)
        {
            $appointment->delete();
        }
        return redirect(route('appointment.index'));
    }
}
