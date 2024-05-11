<?php

namespace Database\Seeders;

use App\Models\TipoAmbiente;
use Illuminate\Database\Seeder;

class TipoAmbienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoambiente = new TipoAmbiente();
        $tipoambiente->nombreTipo = 'Aula Comun';
        $tipoambiente->save();

        $tipoambiente2 = new TipoAmbiente();
        $tipoambiente2->nombreTipo = 'Laboratorio';
        $tipoambiente2->save();

        $tipoambiente3 = new TipoAmbiente();
        $tipoambiente3->nombreTipo = 'Auditorio';
        $tipoambiente3->save();

    }
}
