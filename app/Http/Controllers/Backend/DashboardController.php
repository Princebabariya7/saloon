<?php

namespace App\Http\Controllers\Backend;

use App\Models\Appointment;
use App\Models\Payment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $appointmentCount = Appointment::leftjoin('appointment_detail', 'appointments.id', '=', 'appointment_detail.appointment_id')
            ->where('type', 'Appointment')
            ->count();

        $orderCount = Appointment::leftjoin('appointment_detail', 'appointments.id', '=', 'appointment_detail.appointment_id')
            ->where('type', 'HomeService')
            ->count();
        $userCount  = User::count();

        $allPayment   = Payment::all()->pluck('total')->toArray();
        $totalPayment = array_sum($allPayment);

        return view('Backend.index', [
            'appointmentCount' => $appointmentCount,
            'orderCount'       => $orderCount,
            'userCount'        => $userCount,
            'totalAmount'      => $totalPayment,
        ]);
    }
}
