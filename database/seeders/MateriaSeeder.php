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
        $mimateria->departamento = 'Depto de Informatica';
        $mimateria->carrera = 'licenciatura en ingenieria informatica';
        $mimateria->nombre = 'Calculo I';
        $mimateria->codigo = 142772;
        $mimateria->nivel = 'A';
        $mimateria->cantGrupo = 2;
        $mimateria->save();

        $mimateria2 = new Materia();
        $mimateria2->departamento = 'Depto de Sistemas';
        $mimateria2->carrera = 'licenciatura en ingenieria de sistemaas';
        $mimateria2->nombre = 'Base de datos I';
        $mimateria2->codigo = 215896;
        $mimateria2->nivel = 'C';
        $mimateria2->cantGrupo = 1;
        $mimateria2->save();

        $mimateria3 = new Materia();
        $mimateria3->departamento = 'Depto de Matematica';
        $mimateria3->carrera = 'licenciatura en ingenieria informatica';
        $mimateria3->nombre = 'taller de ingenieria de software';
        $mimateria3->codigo = 657415;
        $mimateria3->nivel = 'G';
        $mimateria3->cantGrupo = 3;
        $mimateria3->save();

    }
}
