<?php

namespace App\Observers;

use App\Mail\OrderMail;
use App\Models\Appointment;
use App\Models\AppointmentDetail;
use App\Models\AppointmentSlot;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class AppointmentObserver
{
    public function created(Appointment $appointment)
    {
        $appointmentData      = session()->get('AppointmentData');
        $appointmentEmailData = $serviceName = [];
        foreach ($appointmentData['service_id'] as $key => $serviceId)
        {
            $appointmentDetail = AppointmentDetail::create([
                'appointment_id' => $appointment->id,
                'service_id'     => $serviceId,
            ]);
            $serviceName[]     = $appointmentDetail->services->name;
        }
        $input = [
            'date'           => Carbon::create($appointmentData['date'])->format('Y-m-d'),
            'slot'           => $appointmentData['time'],
            'appointment_id' => $appointment->id,
        ];
        AppointmentSlot::create($input);
        $appointmentEmailData            = [
            'user'     => auth()->user()->firstname,
            'category' => $appointmentDetail->services->categories->type,
            'date'     => Carbon::parse($appointmentDetail->appointment->date)->format('d-m-Y'),
            'time'     => $appointmentDetail->appointment->time,
        ];
        $appointmentEmailData['service'] = implode(',', $serviceName);
        $this->appointmentConformationMail($appointmentEmailData);

        session()->forget('AppointmentData');
    }

    public function appointmentConformationMail($appointmentDetail)
    {
        Mail::to(auth()->user()->email)->send(new OrderMail($appointmentDetail));
    }
}
