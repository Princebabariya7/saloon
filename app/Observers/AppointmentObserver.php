<?php

namespace App\Observers;

use App\Models\Appointment;
use App\Models\AppointmentDetail;
use App\Models\AppointmentSlot;
use Illuminate\Support\Carbon;

class AppointmentObserver
{
    public function creating(Appointment $appointment)
    {
        //
    }

    public function created(Appointment $appointment)
    {
        $AppointmentData = session()->get('AppointmentData');

        foreach ($AppointmentData['service_id'] as $serviceId)
        {
            AppointmentDetail::create([
                'appointment_id' => $appointment->id,
                'service_id'     => $serviceId,
                'user_id'        => auth()->user()->id,
            ]);
        }
        $input = [
            'date'           => Carbon::create($AppointmentData['date'])->format('Y-m-d'),
            'slot'           => $AppointmentData['time'],
            'appointment_id' => $appointment->id,
            'user_id'        => auth()->user()->id,
        ];
        AppointmentSlot::create($input);
    }

    public function updated(Appointment $appointment)
    {
        //
    }

    public function deleted(Appointment $appointment)
    {
        //
    }

}
