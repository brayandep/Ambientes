<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\BackupController;

class GenerateBackup extends Command
{
    protected $signature = 'backup:generate';
    protected $description = 'Generar un backup de la base de datos';

    public function handle()
    {
        $backupController = new BackupController();
        $backupController->store();
    }
}
