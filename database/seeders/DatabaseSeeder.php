<?php

namespace Database\Seeders;

use App\Models\Materia;
use App\Models\Unidad;
use App\Models\TipoAmbiente;
use App\Models\Ambiente;
use App\Models\Models\Usuario;
use App\Models\Equipo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\TipoAmbiente;
use App\Models\Ambiente;
use App\Models\Unidad;
use App\Models\Equipo;
use App\Models\HorarioDisponible;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        $tiposAmbientes = ['Auditorio', 'Aula', 'Laboratorio', 'Sala de reuniones'];
        foreach ($tiposAmbientes as $tipoAmbiente) {
            TipoAmbiente::create(['nombreTipo' => $tipoAmbiente]);
        }

        // Crear unidades
        Unidad::create([
            'nombreUnidad' => 'Unidad 1',
            'codigoUnidad' => 1,
            'Responsable' => 'Responsable 1',
            'Nivel' => 1,
            'Dependencia' => 1,
            'UnidadHabilitada' => 1,
        ]);
        Unidad::create([
            'nombreUnidad' => 'Unidad 2',
            'codigoUnidad' => 1,
            'Responsable' => 'Responsable 1',
            'Nivel' => 1,
            'Dependencia' => 1,
            'UnidadHabilitada' => 0,
        ]);
        Unidad::create([
            'nombreUnidad' => 'Unidad 3',
            'codigoUnidad' => 1,
            'Responsable' => 'Responsable 1',
            'Nivel' => 1,
            'Dependencia' => 1,
            'UnidadHabilitada' => 1,
        ]);

        // Crear ambientes
        Ambiente::create([
            'tipo_ambiente_id' => 1, // Suponiendo que el primer tipo de ambiente es 'Auditorio'
            'codigo' => 'A1',
            'unidad' => 'Unidad 1',
            'nombre' => 'Auditorio 1',
            'capacidad' => 100,
            'ubicacion' => 'Ubicacion del auditorio 1',
            'descripcion_ubicacion' => 'Descripción del auditorio 1',
            'estadoAmbiente' => 1,
        ]);

        // Crear equipos
        Equipo::create([
            'tipo_ambiente_id' => 1, 
            'ambiente_id' => null, 
            'nombreEquipo' => 'Proyector',
            'estadoEquipo' => 1,
        ]);
        Equipo::create([
            'tipo_ambiente_id' => 1, 
            'ambiente_id' => null, 
            'nombreEquipo' => 'Data-Display',
            'estadoEquipo' => 1,
        ]);
        Equipo::create([
            'tipo_ambiente_id' => 2, 
            'ambiente_id' => null, 
            'nombreEquipo' => 'Sillas',
            'estadoEquipo' => 1,
        ]);
        Equipo::create([
            'tipo_ambiente_id' => 2, 
            'ambiente_id' => null, 
            'nombreEquipo' => 'Pizarra',
            'estadoEquipo' => 1,
        ]);
        Equipo::create([
            'tipo_ambiente_id' => 2, 
            'ambiente_id' => null, 
            'nombreEquipo' => 'Mesas',
            'estadoEquipo' => 0,
        ]);

        // Crear horarios disponibles
        HorarioDisponible::create([
            'ambiente_id' => 1,
            'horaInicio' => '08:00',
            'horaFin' => '10:00',
            'estadoHorario' => true,
            'dia' => 'Lunes',
        ]);
    }
        
        
        $this -> call(UnidadSeeder::class);
        $this -> call(EquipoSeeder::class);
        $this -> call(TipoAmbiente::class);
        $this -> call(UsuarioSeeder::class);
    }
    
}
