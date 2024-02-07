<?php

namespace App\Observers;

use App\Mail\OrderMail;
use App\Models\Appointment;
use App\Models\AppointmentSlot;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class PaymentObserver
{
    public function created(Payment $payment)
    {
        try
        {
            $session = session()->get('AppointmentData');

            foreach ($session['service_id'] as $serviceId)
            {
                $appointment = Appointment::create([
                    'service_id' => $serviceId,
                    'type'       => $session['type'],
                    'date'       => Carbon::create($session['date'])->format('Y-m-d'),
                    'time'       => $session['time'],
                    'user_id'    => auth()->user()->id,
                    'status'     => 'Active',
                    'updated_at' => now(),
                    'created_at' => Carbon::now(),
                ]);

                $input = [
                    'date'           => $appointment->date,
                    'slot'           => $session['time_slot'],
                    'appointment_id' => $appointment->id,
                    'user_id'        => $appointment->user_id
                ];
                AppointmentSlot::create($input);
            }
            session()->put('msg', 'Your Appointment Has Successfully Booked');
            Mail::to(auth()->user()->email)->send(new OrderMail($appointment));

        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updated(Payment $payment)
    {
        //
    }

    public function deleted(Payment $payment)
    {
        //
    }
}
