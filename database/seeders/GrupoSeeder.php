<?php

namespace Database\Seeders;

use App\Models\Grupo;
use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $migrupo = new Grupo();
        $migrupo->numero = 1;
        $migrupo->idDocente = 4;
        $migrupo->idMateria = 1;
        $migrupo->save();

        $migrupo2 = new Grupo();
        $migrupo2->numero = 2;
        $migrupo2->idDocente = 6;
        $migrupo2->idMateria = 1;
        $migrupo2->save();

        $migrupo3 = new Grupo();
        $migrupo3->numero = 1;
        $migrupo3->idDocente = 2;
        $migrupo3->idMateria = 2;
        $migrupo3->save();

        $migrupo4 = new Grupo();
        $migrupo4->numero = 1;
        $migrupo4->idDocente = 1;
        $migrupo4->idMateria = 3;
        $migrupo4->save();

        $migrupo5 = new Grupo();
        $migrupo5->numero = 2;
        $migrupo5->idDocente = 3;
        $migrupo5->idMateria = 3;
        $migrupo5->save();

        $migrupo6 = new Grupo();
        $migrupo6->numero = 3;
        $migrupo6->idDocente = 6;
        $migrupo6->idMateria = 3;
        $migrupo6->save();
    }
}
