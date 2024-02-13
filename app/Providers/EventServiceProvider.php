<?php

namespace App\Providers;

use App\Models\Appointment;
use App\Models\Payment;
use App\Observers\AppointmentObserver;
use App\Observers\PaymentObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    public function boot()
    {
        Appointment::observe(AppointmentObserver::class);
        Payment::observe(PaymentObserver::class);
    }
}
