<?php

namespace Database\Seeders;

use App\Models\Materia;
use App\Models\TipoAmbiente;
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
        // \App\Models\User::factory(10)->create();
        $this -> call(UnidadSeeder::class);
        Materia::factory(35)->create();
        $this -> call(EquipoSeeder::class);
        $this -> call(TipoAmbienteSeeder::class);
    }
}
