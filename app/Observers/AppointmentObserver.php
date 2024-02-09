<?php

namespace App\Observers;

use App\Models\Appointment;

class AppointmentObserver
{
    public function creating(Appointment $appointment)
    {
        dd($appointment);
    }

    public function created(Appointment $appointment)
    {
    //
    }

    public function updated(Appointment $appointment)
    {
        //
    }

    public function deleted(Appointment $appointment)
    {
        //
    }

    public function restored(Appointment $appointment)
    {
        //
    }

    public function forceDeleted(Appointment $appointment)
    {
        //
    }
}
