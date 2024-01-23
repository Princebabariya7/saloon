<?php

namespace App\Http\Controllers\Backend;

use App\Models\Appointment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $appointmentCount = Appointment::where('type', 'Appointment')->count();
        $orderCount = Appointment::where('type', 'Order')->count();
        $userCount = User::count();

        return view('Backend.index', [
            'appointmentCount' => $appointmentCount,
            'orderCount' => $orderCount,
            'userCount' => $userCount,
        ]);
    }

    public function appointmentDetails()
    {
        $appointments = Appointment::where('type', 'Appointment')->paginate(10);
        return view('Backend.appointment.index')->with('appointments', $appointments);
    }

    public function orderDetails()
    {
        $orders = Appointment::where('type', 'Order')->paginate(10);
        return view('Backend.appointment.index')->with('appointments', $orders);
    }
}



