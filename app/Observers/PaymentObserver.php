<?php

namespace App\Observers;

use App\Models\Appointment;
use App\Models\Payment;

class PaymentObserver
{
    public function created(Payment $payment)
    {
        $appointments       = Appointment::find($payment->appointment_id);

        if ($payment->status == 'Success'){
            $appointments->status = 'Success';
            $appointments->update();
        }
    }
}
