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


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this -> call(UnidadSeeder::class);
        $this -> call(EquipoSeeder::class);
        $this -> call(TipoAmbienteSeeder::class);
        $this -> call(UsuarioSeeder::class);

        $this -> call(DocenteSeeder::class);
        $this -> call(MateriaSeeder::class);
        $this -> call(GrupoSeeder::class);
        $this -> call(SeederTablaPermisos::class);
    }
    
}
