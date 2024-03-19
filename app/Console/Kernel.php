<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('employeebirthdayNotification:every_day')->dailyAt('7:00')->sendOutputTo('command1_output.log');
        $schedule->command('applicantbirthdayNotification:every_day')->dailyAt('7:00')->sendOutputTo('command2_output.log');
        $schedule->command('workAnniversary:every_day')->everyMinute()->sendOutputTo('command3_output.log');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
