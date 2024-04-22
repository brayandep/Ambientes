<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;



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
    }
    
}
