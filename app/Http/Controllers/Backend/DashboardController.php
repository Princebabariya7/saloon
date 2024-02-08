<?php

namespace App\Http\Controllers\Backend;

use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $appointmentCount = Appointment::where('type', 'Appointment')->count();
        $orderCount       = Appointment::where('type', 'HomeService')->count();
        $userCount        = User::count();

        return view('Backend.index', [
            'appointmentCount' => $appointmentCount,
            'orderCount'       => $orderCount,
            'userCount'        => $userCount,
        ]);
    }

    public function appointmentDetails()
    {
        $currentDate  = Carbon::now();
        $appointments = Appointment::where('type', 'Appointment')->paginate(10);
        return view('Backend.appointment.index')->with('appointments', $appointments)
            ->with('currentDate', $currentDate);

    }

    public function orderDetails()
    {
        $currentDate = Carbon::now();
        $orders      = Appointment::where('type', 'HomeService')->paginate(10);
        return view('Backend.appointment.index')->with('appointments', $orders)
            ->with('currentDate', $currentDate);
    }
}



