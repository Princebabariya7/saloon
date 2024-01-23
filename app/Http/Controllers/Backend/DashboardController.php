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
}



