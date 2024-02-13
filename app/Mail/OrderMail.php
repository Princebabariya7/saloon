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

    public AppointmentDetail $AppointmentDetail;

    public function __construct($AppointmentDetail)
    {
        $this->AppointmentDetail = $AppointmentDetail;
    }

    public function build()
    {
        return $this->subject('Appointment Conformation')->view('Mails.mail');
    }
}
