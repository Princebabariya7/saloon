<?php

namespace App\Console\Commands;

use App\Mail\AppointmentReminderMail;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    protected $signature = 'send:email';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        foreach (Appointment::all() as $appointment)
        {
            $currentDate                = Carbon::now();
            $startAndEndAppointmentTime = explode(' -', $appointment->time);
            $startTime                  = $startAndEndAppointmentTime[0];
            $date                       = $appointment->date;
            $convertedTime              = Carbon::createFromFormat('g:i A', $startTime)->format('H:i');
            $startDateTimeString        = $date . ' ' . $convertedTime;
            $startCarbonDate            = Carbon::create($startDateTimeString);
            $minutesDifference          = $startCarbonDate->diffInMinutes($currentDate);
            //if ($minutesDifference <= 30 && $minutesDifference >= 25)
            if ($minutesDifference == 60)
            {
                Mail::to($appointment->user->email)->send(new AppointmentReminderMail($appointment));

                $this->info('Email sent successfully.');
            }
        }
    }
}
