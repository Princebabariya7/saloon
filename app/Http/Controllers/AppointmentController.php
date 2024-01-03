<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentAddRequest;
use App\Http\Requests\AppointmentEditRequest;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->input('search', '');
        $package = $request->input('package', '');
        if ($search != '')
        {
            $appointments = Appointment::when($search, function ($query, $search)
            {
                return
                    $query->where('package', 'LIKE', '%' . $search . '%')
                        ->orWhere('stylist', 'LIKE', '%' . $search . '%');
            })->paginate(5);
        }
        elseif ($package != '')
        {
            $appointments = Appointment::when($package, function ($query, $package)
            {
                return
                    $query->where('package', 'LIKE', '%' . $package . '%');
            })->paginate(5);
        }
        else
        {
            $appointments = Appointment::paginate(5);
        }

        return view('book.appointmentview')->with('appointments', $appointments);
    }

    public function create()
    {
        return view('book.appointment')->with('editMode', false);
    }

    public function store(AppointmentAddRequest $request)
    {
        try
        {
            Appointment::create([
                'package'          => implode(',', $request->package),
                'stylist'          => $request->stylist,
                'appointment_time' => Carbon::createFromFormat('m/d/Y g:i A', $request->appointment_time)->format('Y-m-d H:i:s'),
                'updated_at'       => now(),
                'created_at'       => Carbon::now(),
            ]);
            session()->put('msg', 'Appointment booked');
            return redirect(route('appointment.create'));
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $appointment = Appointment::find($id);
        return view('book.appointment')
            ->with('appointment', $appointment)
            ->with('package', explode(',', $appointment->package))
            ->with('appointment_time', (Carbon::create($appointment->appointment_time)->format('m-d-y H:i:s')))
            ->with('editMode', true);
    }


    public function update(AppointmentEditRequest $request, $id)
    {
        $appointment                   = Appointment::find($id);
        $appointment->package          = implode(',', $request->package);
        $appointment->stylist          = $request->input('stylist');
        $appointment->appointment_time = Carbon::create($request->appointment_time)->format('Y-m-d H:i:s');;
        $appointment->update();

        session()->put('update', 'your appointment was updated');
        return redirect(route('appointment.index'));
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
