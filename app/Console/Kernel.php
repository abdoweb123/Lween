<?php

namespace App\Console;

use App\Console\Commands\BillsPayable;
use App\Console\Commands\SendMeetingsContent;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SendMeetingsContent::class,
        BillsPayable::class,
    ];

    protected function schedule(Schedule $schedule)
    {

    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
