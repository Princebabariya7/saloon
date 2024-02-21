<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Appointment;

class AppointmentReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;

//    public function __construct(Appointment $appointment)
//    {
//        $this->appointment = $appointment;
//    }
    public function __construct()
    {

    }

    public function build()
    {
        return $this->subject('Appointment Reminder')
            ->view('Mails.appointment_reminder');
    }
}
