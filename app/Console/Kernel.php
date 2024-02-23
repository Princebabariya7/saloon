<?php

namespace App\Console;

use App\Console\Commands\SendEmail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command('send:email')->everyTenMinutes();
        $schedule->command('send:email')->everyMinute();
    }

    protected $commands = [
        SendEmail::class,
    ];
}
