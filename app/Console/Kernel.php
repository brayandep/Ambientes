<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\File;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $configPath = storage_path('app/backup_schedule.json');

        if (File::exists($configPath)) {
            $config = json_decode(File::get($configPath), true);
            if (!empty($config['cron'])) {
                $schedule->command('backup:generate')->cron($config['cron']);
            }
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
