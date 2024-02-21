<?php

namespace App\Http\Controllers\Backend;

use App\Models\Appointment;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $appointmentCount = Appointment::where('type', 'Appointment')->count();
        $orderCount       = Appointment::where('type', 'HomeService')->count();
        $userCount        = User::count();

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
