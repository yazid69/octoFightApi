<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\FetchPlayerStats::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('fetch:rappers')->daily();
        $schedule->command('update:rapper-streams')->dailyAt('02:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
