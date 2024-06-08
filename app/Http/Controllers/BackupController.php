<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
class BackupController extends Controller
{
    public function index()
    {
        $backups = Storage::files('backup');
        $backupNames = [];
        foreach ($backups as $backup) {
            $backupNames[] = basename($backup);
        }
        return view('backup.backup')->with('backups', $backupNames);
    }

    public function store()
    {
        // Verificar si se puede obtener el nombre de la base de datos
        try {
            $databaseName = DB::getDatabaseName();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'No se pudo establecer la conexión a la base de datos']);
        }

        // Obtener el nombre del archivo de backup
        $backupName = date('d-m-Y_H-i-s') . '_backup.sql';

        // Iniciar la construcción del archivo SQL
        $sql = "-- Respaldo de la base de datos $databaseName\n\n";

        // Agregar configuraciones iniciales
        $sql .= <<<EOL
    /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
    /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
    /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
    /*!40101 SET NAMES utf8mb4 */;
    /*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
    /*!40103 SET TIME_ZONE='+00:00' */;
    /*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
    /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
    /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
    /*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
    EOL;

        // Obtener el listado de tablas en la base de datos
        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $tableName = reset($table);

            // Agregar comando para eliminar la tabla si existe
            $sql .= "DROP TABLE IF EXISTS `$tableName`;\n";

            $tableInfo = DB::select("SHOW CREATE TABLE $tableName");

            // Agregar comando para crear la tabla de nuevo
            $sql .= "/*!40101 SET @saved_cs_client = @@character_set_client */;\n";
            $sql .= "/*!40101 SET character_set_client = utf8 */;\n";
            $sql .= $tableInfo[0]->{'Create Table'} . ";\n";
            $sql .= "/*!40101 SET character_set_client = @saved_cs_client */;\n";

            // Bloquear la tabla antes de insertar datos
            $sql .= "LOCK TABLES `$tableName` WRITE;\n";
            $sql .= "/*!40000 ALTER TABLE `$tableName` DISABLE KEYS */;\n";

            // Agregar los datos de la tabla al archivo SQL
            $tableData = DB::table($tableName)->get()->toArray();
            foreach ($tableData as $row) {
                $sql .= "INSERT INTO `$tableName` VALUES (";

                // Formatear manualmente cada fila de datos
                foreach ($row as $key => $value) {
                    // Si el valor es una cadena, escapar comillas
                    if (is_string($value)) {
                        $value = addslashes($value);
                        $value = "'$value'";
                    } elseif (is_null($value)) {
                        $value = 'NULL';
                    }
                    $sql .= "$value, ";
                }
                // Eliminar la última coma y espacio
                $sql = rtrim($sql, ', ');
                $sql .= ");\n";
            }

            // Desbloquear la tabla después de insertar datos
            $sql .= "/*!40000 ALTER TABLE `$tableName` ENABLE KEYS */;\n";
            $sql .= "UNLOCK TABLES;\n\n";
        }

        // Agregar configuraciones finales
        $sql .= <<<EOL
    /*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
    /*!40114 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
    /*!40101 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
    /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
    /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
    /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
    /*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
    /*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
    EOL;

        // Guardar el archivo de backup
        Storage::put('backup/' . $backupName, $sql);

        return redirect()->back()->with('success', 'Copia de seguridad realizada con éxito');
    }
    

    public function restore(Request $request)
    {
        $restorePoint = $request->input('restorePoint');

        // Concatena la ruta del directorio de backup al nombre del archivo
        $filePath = 'backup/' . $restorePoint;

        // Verifica si el archivo de backup existe
        if (Storage::exists($filePath)) {
            $sqlStatements = explode(";", Storage::get($filePath));
            $totalErrors = 0;
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            foreach ($sqlStatements as $statement) {
                $statement = trim($statement);
                if (!empty($statement)) {
                    try {
                        DB::statement($statement . ';');
                    } catch (\Exception $e) {
                        $totalErrors++;
                    }
                }
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            if ($totalErrors <= 0) {
                return redirect()->back()->with('success', 'Restauración completada con éxito');
            } else {
                return redirect()->back()->withErrors(['error' => 'Ocurrió un error inesperado, no se pudo hacer la restauración completamente']);
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'El archivo de backup no existe']);
        }
    }

    public function destroy($backupName)
    {
        // Concatena el nombre del archivo al directorio de backups
        $filePath = 'backup/' . $backupName;

        // Verifica si el archivo existe antes de intentar eliminarlo
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
            return redirect()->back()->with('success', 'Copia de seguridad eliminada con éxito');
        } else {
            return redirect()->back()->withErrors(['error' => 'El archivo de backup no existe']);
        }
    }


    public function schedule(Request $request)
    {
        $request->validate([
            'dia' => 'in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado',
            'hora' => 'date_format:H:i',
        ],
        [
            'dia.in' => 'Seleccione un dia',
            'hora.date_format' => 'Seleccione una hora',
        ]);
        
        $dia = $request->input('dia');
        $hora = $request->input('hora');

        // Separar la hora y los minutos
        list($hour, $minute) = explode(':', $hora);

        // Construir la expresión cron
        $cronExpression = "{$minute} {$hour} * * " . $this->convertDayToCron($dia);

        // Guardar en un archivo de configuración
        $config = [
            'cron' => $cronExpression,
            'diaVer' => $dia,
            'hora' => $hora,
            'dia' => $this->convertDayToShow($dia),
        ];

        File::put(storage_path('app/backup_schedule.json'), json_encode($config));

        return redirect()->back()->with('backup_programado', "{$dia} a las {$hora}");
    }
    
    private function convertDayToCron($day)
    {
        $days = [
            'Lunes' => 1,
            'Martes' => 2,
            'Miércoles' => 3,
            'Jueves' => 4,
            'Viernes' => 5,
            'Sábado' => 6,
        ];

        return $days[$day];
    }

    private function convertDayToShow($day)
    {
        $days = [
            'Lunes' => 'Monday',
            'Martes' => 'Tuesday',
            'Miércoles' => 'Wednesday',
            'Jueves' => 'Thursday',
            'Viernes' => 'Friday',
            'Sábado' => 'Saturday',
        ];

        return $days[$day];
    }

    public function deleteSchedule()
    {
        if (File::exists(storage_path('app/backup_schedule.json'))) {
            File::delete(storage_path('app/backup_schedule.json'));
            return redirect()->back()->with('success', 'Programación de backup eliminada con éxito');
        } else {
            return redirect()->back()->withErrors(['error' => 'No hay programación de backup para eliminar']);
        }
    }

    public function show($backupName)
    {
        // Verificar si el archivo de backup existe
        if (Storage::exists('backup/' . $backupName)) {
            // Obtener el contenido del archivo de backup
            $backupContent = Storage::get('backup/' . $backupName);
            
            // Devolver una vista con el contenido del backup
            return view('backup.show')->with('backupContent', $backupContent);
        } else {
            // Si el archivo no existe, redireccionar con un mensaje de error
            return redirect()->back()->withErrors(['error' => 'El archivo de backup no existe']);
        }
    }

    public function runBackup(Request $request)
    {
        $token = $request->query('token');

        if ($token !== "pass123cron") {
            abort(403, 'Unauthorized');
        }

        $configPath = storage_path('app/backup_schedule.json');

        if (!File::exists($configPath)) {
            return 'No backup schedule found';
        }

        $config = json_decode(File::get($configPath), true);
        if (empty($config['cron'])) {
            return 'No backup schedule found';
        }

        // Obtener la hora actual
        $currentHour = date('H:i');

        // Obtener el día actual
        $currentDay = date('l');

        // Obtener la hora programada del archivo JSON
        $scheduledHour = $config['hora'];

        // Obtener el día programado del archivo JSON
        $scheduledDay = $config['dia'];

        // Verificar si es el día correcto y la hora adecuada
        if ($currentDay === $scheduledDay && $currentHour === $scheduledHour) {
            Artisan::call('backup:generate');
            return 'Backup command executed';
        } else {
            return 'No backup scheduled at this time';
        }
    }
}
