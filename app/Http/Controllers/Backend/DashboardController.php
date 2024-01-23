<?php

namespace App\Http\Controllers\Backend;

use App\Models\Onlineorders;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $appointmentCount = Onlineorders::where('type', 'Appointment')->count();
        $orderCount = Onlineorders::where('type', 'Order')->count();
        $userCount = User::count();

        return view('Backend.index', [
            'appointmentCount' => $appointmentCount,
            'orderCount' => $orderCount,
            'userCount' => $userCount,
        ]);
    }

    public function appointmentDetails()
    {
        $appointments = Onlineorders::where('type', 'Appointment')->paginate(10);
        return view('Backend.appointment.index')->with('appointments', $appointments);
    }

    public function orderDetails()
    {
        $orders = Onlineorders::where('type', 'Order')->paginate(10);
        return view('Backend.appointment.index')->with('appointments', $orders);
    }
}



