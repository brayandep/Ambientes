<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
class BackupController extends Controller
{
    public function index()
    {
        $backups = Storage::files('backup');
        return view('backup.backup')->with('backups', $backups);
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
        $backupName = date('d_m_Y_H-i-s') . '.sql';

        // Iniciar la construcción del archivo SQL
        $sql = "-- Respaldo de la base de datos $databaseName\n\n";

        // Obtener el listado de tablas en la base de datos
        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $tableName = reset($table);
            $tableInfo = DB::select("SHOW CREATE TABLE $tableName");

            // Agregar la estructura de la tabla al archivo SQL
            $sql .= $tableInfo[0]->{'Create Table'} . ";\n\n";

            // Agregar los datos de la tabla al archivo SQL
            $tableData = DB::table($tableName)->get()->toArray();
            foreach ($tableData as $row) {
                $row = (array) $row;
                $sql .= "INSERT INTO $tableName VALUES ('" . implode("', '", array_map('addslashes', $row)) . "');\n";
            }
            $sql .= "\n";
        }

        // Guardar el archivo de backup
        Storage::put('backup/' . $backupName, $sql);

        return redirect()->back()->with('success', 'Copia de seguridad realizada con éxito');
    }

    public function restore(Request $request)
    {
        $restorePoint = $request->input('restorePoint');
        $sql = explode(";", Storage::get($restorePoint));
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
    }

    public function destroy($backupName)
    {
        Storage::delete($backupName);
        return redirect()->back()->with('success', 'Copia de seguridad eliminada con éxito');
    }
}
