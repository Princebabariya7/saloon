<?php

namespace App\Observers;

use App\Mail\OrderMail;
use App\Models\Appointment;
use App\Models\AppointmentDetail;
use App\Models\AppointmentSlot;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AppointmentObserver
{
    public function created(Appointment $appointment)
    {
        $AppointmentData = session()->get('AppointmentData');

        foreach ($AppointmentData['service_id'] as $serviceId)
        {
            $AppointmentDetail = AppointmentDetail::create([
                'appointment_id' => $appointment->id,
                'service_id'     => $serviceId,
                'user_id'        => auth()->user()->id,
            ]);
            $this->AppointmentConformationMail($AppointmentDetail);
        }
        $input = [
            'date'           => Carbon::create($AppointmentData['date'])->format('Y-m-d'),
            'slot'           => $AppointmentData['time'],
            'appointment_id' => $appointment->id,
            'user_id'        => auth()->user()->id,
        ];
        AppointmentSlot::create($input);
        session()->forget('AppointmentData');
    }

    public function AppointmentConformationMail($AppointmentDetail)
    {
        Mail::to(auth()->user()->email)->send(new OrderMail($AppointmentDetail));
    }
}
