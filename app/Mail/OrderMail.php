<?php

namespace App\Mail;

use App\Models\AppointmentDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\Appointment;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointmentDetail;

    public function __construct($appointmentDetail)
    {
        $this->appointmentDetail = $appointmentDetail;
    }

    public function build()
    {
        return $this->subject('Appointment Conformation')->view('Mails.mail');
    }
}
