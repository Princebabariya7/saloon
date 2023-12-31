<?php

namespace App\Http\Controllers\frontend;

use App\Http\Requests\frontend\AppointmentAddRequest;
use App\Http\Requests\frontend\AppointmentEditRequest;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $search       = $request->input('search', '');
        $service      = $request->input('service', '');
        $appointments = Appointment::when($search, function ($query) use ($search)
        {
            return $query->where(function ($query) use ($search)
            {
                $query->orwhere('service', 'LIKE', '%' . $search . '%')
                    ->orWhere('stylist', 'LIKE', '%' . $search . '%');
            });
        })->when($service, function ($query) use ($service)
        {
            return
                $query->where('package', $service);
        })->paginate(5);

        return view('frontend.book.appointmentview')->with('appointments', $appointments);
    }

    public function create()
    {
        return view('frontend.book.appointment')->with('editMode', false);
    }

    public function store(AppointmentAddRequest $request)
    {
        try
        {
            Appointment::create([
                'service'          => implode(',', $request->service),
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
        return view('frontend.book.appointment')
            ->with('appointment', $appointment)
            ->with('service', explode(',', $appointment->service))
            ->with('appointment_time', (Carbon::create($appointment->appointment_time)->format('m-d-y H:i:s')))
            ->with('editMode', true);
    }


    public function update(AppointmentEditRequest $request, $id)
    {
        $appointment                   = Appointment::find($id);
        $appointment->service          = implode(',', $request->service);
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
