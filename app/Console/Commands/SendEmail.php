<?php

namespace App\Console\Commands;

use App\Mail\AppointmentReminderMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    protected $signature = 'send:email';
    protected $description = 'Send an email every 5 minutes';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        // Code to send the email using Laravel's Mail facade or any other mail library
        Mail::to('yashbuha4044e@gmail.com')->send(new AppointmentReminderMail());

        $this->info('Email sent successfully.');
    }
}
