<?php

namespace App\Observers;

use App\Models\Payment;

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
