<?php

namespace App\Http\Controllers\Backend;

use App\Models\Appointment;
use App\Models\AppointmentDetail;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;

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

        $paymentDetails = Payment::all()->pluck('transaction_detail')->toArray();
        $totalAmount    = collect($paymentDetails)->map(function ($detail)
        {
            $decodedDetail = json_decode($detail, true);
            return $decodedDetail['total'] ?? 0;
        })->sum();
        return view('Backend.index', [
            'appointmentCount' => $appointmentCount,
            'orderCount'       => $orderCount,
            'userCount'        => $userCount,
            'totalAmount'      => $totalAmount,
        ]);
    }

    public function appointmentDetails()
    {
        $currentDate       = Carbon::now();
        $appointmentDetail = AppointmentDetail::
        leftJoin('appointments', 'appointments.id', '=', 'appointment_detail.appointment_id')->where('type','Appointment')->paginate(5);

        return view('Backend.appointment.index')->with('appointments', $appointmentDetail)
            ->with('currentDate', $currentDate);
    }

    public function orderDetails()
    {
        $currentDate = Carbon::now();
        $orders      = AppointmentDetail::
        leftJoin('appointments', 'appointments.id', '=', 'appointment_detail.appointment_id')->where('type','HomeService')->paginate(5);

        return view('Backend.appointment.index')->with('appointments', $orders)
            ->with('currentDate', $currentDate);
    }
}
