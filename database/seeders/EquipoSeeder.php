<?php

namespace Database\Seeders;

use App\Models\Equipo;
use Illuminate\Database\Seeder;

class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipo = new Equipo();
        $equipo->tipo_ambiente_id = 1;
        $equipo->ambiente_id = null;
        $equipo->nombreEquipo = 'Pizarra';
        $equipo->estadoEquipo = true;
        $equipo->save();

        $equipo2 = new Equipo();
        $equipo2->tipo_ambiente_id = 1;
        $equipo2->ambiente_id = null;
        $equipo2->nombreEquipo = 'Data Display';
        $equipo2->estadoEquipo = true;
        $equipo2->save();

        $equipo3 = new Equipo();
        $equipo3->tipo_ambiente_id = 1;
        $equipo3->ambiente_id = null;
        $equipo3->nombreEquipo = 'Pupitres';
        $equipo3->estadoEquipo = true;
        $equipo3->save();

        $equipo4 = new Equipo();
        $equipo4->tipo_ambiente_id = 1;
        $equipo4->ambiente_id = null;
        $equipo4->nombreEquipo = 'Computadoras';
        $equipo4->estadoEquipo = true;
        $equipo4->save();

        $equipo5 = new Equipo();
        $equipo5->tipo_ambiente_id = 1;
        $equipo5->ambiente_id = null;
        $equipo5->nombreEquipo = 'Routers';
        $equipo5->estadoEquipo = true;
        $equipo5->save();

        $equipo6 = new Equipo();
        $equipo6->tipo_ambiente_id = 1;
        $equipo6->ambiente_id = null;
        $equipo6->nombreEquipo = 'Microtiks';
        $equipo6->estadoEquipo = true;
        $equipo6->save();
    }
}
