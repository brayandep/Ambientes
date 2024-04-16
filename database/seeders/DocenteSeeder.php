<?php

namespace Database\Seeders;

use App\Models\Docente;
use Illuminate\Database\Seeder;

class DocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $docente1 = new Docente();
        $docente1 -> nombreDocente = "Erika Patricia Rodríguez Bilbao";
        $docente1 -> save();

        $docente2 = new Docente();
        $docente2 -> nombreDocente = "Luis Roberto Agréda Corrales";
        $docente2 -> save();

        $docente3 = new Docente();
        $docente3 -> nombreDocente = "Tatiana Aparicio Yuja";
        $docente3 -> save();

        $docente4 = new Docente();
        $docente4 -> nombreDocente = "Ligia Jacqueline Aranibar Lafuente";
        $docente4 -> save();

        $docente5 = new Docente();
        $docente5 -> nombreDocente = "Javier Caballero Flores";
        $docente5-> save();

        $docente6 = new Docente();
        $docente6 -> nombreDocente = "David Escalera Fernández";
        $docente6 -> save();

        $docente7 = new Docente();
        $docente7 -> nombreDocente = "Carla Salazar Serrudo";
        $docente7 -> save();

        $docente8 = new Docente();
        $docente8 -> nombreDocente = "Juan Terrazas Lobo";
        $docente8 -> save();

        $docente9 = new Docente();
        $docente9 -> nombreDocente = "Jorge Walter Orellana Araoz";
        $docente9 -> save();

        $docente10 = new Docente();
        $docente10 -> nombreDocente = "Corina Flores Villarroel";
        $docente10 -> save();

        $docente11 = new Docente();
        $docente11 -> nombreDocente = "Boris Calancha Navia";
        $docente11 -> save();

    }
}
