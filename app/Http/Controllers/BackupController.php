<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        $backupName = date('d_m_Y_H-i-s') . '_backup.sql';

        // Iniciar la construcción del archivo SQL
        $sql = "-- Respaldo de la base de datos $databaseName\n\n";

        // Agregar comando para deshabilitar las verificaciones de clave externa
        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        // Agregar comando para crear la base de datos si no existe y seleccionarla
        $sql .= "CREATE DATABASE IF NOT EXISTS $databaseName;\n";
        $sql .= "USE $databaseName;\n\n";

        // Obtener el listado de tablas en la base de datos
        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $tableName = reset($table);

            // Agregar comando para eliminar la tabla si existe
            $sql .= "DROP TABLE IF EXISTS $tableName;\n\n";

            $tableInfo = DB::select("SHOW CREATE TABLE $tableName");

            // Agregar comando para crear la tabla de nuevo
            $sql .= $tableInfo[0]->{'Create Table'} . ";\n\n";

            // Agregar los datos de la tabla al archivo SQL
            $tableData = DB::table($tableName)->get()->toArray();
            foreach ($tableData as $row) {
                $sql .= "INSERT INTO $tableName VALUES (";

                // Formatear manualmente cada fila de datos
                foreach ($row as $key => $value) {
                    // Si el valor es una cadena, escapar comillas
                    if (is_string($value)) {
                        $value = addslashes($value);
                    }
                    $sql .= "'$value', ";
                }
                // Eliminar la última coma y espacio
                $sql = rtrim($sql, ', ');
                $sql .= ");\n";
            }
            $sql .= "\n\n\n";
        }

        // Agregar comando para habilitar las verificaciones de clave externa
        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n\n";

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
            $sql = explode(";", Storage::get($filePath));
            $totalErrors = 0;
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            foreach ($sql as $query) {
                if (!empty(trim($query))) {
                    try {
                        DB::statement($query);
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
}
