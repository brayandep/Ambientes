<?php

namespace Database\Seeders;

use App\Models\Materia;
use Illuminate\Database\Seeder;

class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mimateria = new Materia();
        $mimateria->departamento = 'Departamento1';
        $mimateria->carrera = 'Ingenieria Eelectrica';
        $mimateria->nombre = 'Calculo I';
        $mimateria->codigo = 142772;
        $mimateria->nivel = 'A';
        $mimateria->cantGrupo = 3;
        $mimateria->save();

        $mimateria2 = new Materia();
        $mimateria2->departamento = 'Departamento4';
        $mimateria2->carrera = 'Ingenieria de Sistemas';
        $mimateria2->nombre = 'Algebra II';
        $mimateria2->codigo = 215896;
        $mimateria2->nivel = 'B';
        $mimateria2->cantGrupo = 2;
        $mimateria2->save();

        $mimateria3 = new Materia();
        $mimateria3->departamento = 'Departamento4';
        $mimateria3->carrera = 'Ingenieria Civil';
        $mimateria3->nombre = 'Calculo II';
        $mimateria3->codigo = 657415;
        $mimateria3->nivel = 'B';
        $mimateria3->cantGrupo = 2;
        $mimateria3->save();

        $mimateria4 = new Materia();
        $mimateria4->departamento = 'Departamento4';
        $mimateria4->carrera = 'Ingenieria Mecanica';
        $mimateria4->nombre = 'Circuitos Electronicos';
        $mimateria4->codigo = 135687;
        $mimateria4->nivel = 'A';
        $mimateria4->cantGrupo = 4;
        $mimateria4->save();
    }
}
