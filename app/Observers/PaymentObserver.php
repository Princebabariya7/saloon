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
       //
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
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
