<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unidad;
use App\Models\Dependencia;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $unidad1 = new Unidad();
        $unidad1 -> nombreUnidad = "Consejo facultativo de la FCyT";
        $unidad1 -> codigoUnidad = 111111;
        $unidad1 -> Responsable = "Doc Responsable";
        $unidad1 -> Nivel = 1;
        $unidad1 -> Dependencia = 0;
        $unidad1 -> UnidadHabilitada = 1;
        $unidad1 -> save();

        $unidad2 = new Unidad();
        $unidad2 -> nombreUnidad = "Decano de FCyt";
        $unidad2 -> codigoUnidad = 122222;
        $unidad2 -> Responsable = "Ing MARCELO TORREJON";
        $unidad2 -> Nivel = 2;
        $unidad2 -> Dependencia = 1;
        $unidad2 -> UnidadHabilitada = 1;
        $unidad2 -> save();

        $dependencia1 = new Dependencia();
        $dependencia1 -> idunidadPadre = 1;
        $dependencia1 -> idunidadHijo = 2;
        $dependencia1 -> save();

        $unidad3 = new Unidad();
        $unidad3 -> nombreUnidad = "Depto de Informatica";
        $unidad3 -> codigoUnidad = 345345;
        $unidad3 -> Responsable = "Lic BORIS CALANCHA";
        $unidad3 -> Nivel = 3;
        $unidad3 -> Dependencia = 2;
        $unidad3 -> UnidadHabilitada = 1;
        $unidad3 -> save();

        $dependencia2 = new Dependencia();
        $dependencia2 -> idunidadPadre = 2;
        $dependencia2 -> idunidadHijo = 3;
        $dependencia2 -> save();

        $unidad4 = new Unidad();
        $unidad4 -> nombreUnidad = "Depto de Industrial";
        $unidad4 -> codigoUnidad = 318341;
        $unidad4 -> Responsable = "Ing MIGUEL GUTIERREZ";
        $unidad4 -> Nivel = 3;
        $unidad4 -> Dependencia = 2;
        $unidad4 -> UnidadHabilitada = 1;
        $unidad4 -> save();

        $dependencia3 = new Dependencia();
        $dependencia3 -> idunidadPadre = 2;
        $dependencia3 -> idunidadHijo = 4;
        $dependencia3 -> save();

        $unidad5 = new Unidad();
        $unidad5 -> nombreUnidad = "Depto de Matematica";
        $unidad5 -> codigoUnidad = 310000;
        $unidad5 -> Responsable = "Ing ALFREDO DELGADILLO";
        $unidad5 -> Nivel = 3;
        $unidad5 -> Dependencia = 2;
        $unidad5 -> UnidadHabilitada = 1;
        $unidad5 -> save();

        $dependencia4 = new Dependencia();
        $dependencia4 -> idunidadPadre = 2;
        $dependencia4 -> idunidadHijo = 5;
        $dependencia4 -> save();

        $unidad6 = new Unidad();
        $unidad6 -> nombreUnidad = "Depto de Sistemas";
        $unidad6 -> codigoUnidad = 344345;
        $unidad6 -> Responsable = "Ing RICHARD AYAROA";
        $unidad6 -> Nivel = 3;
        $unidad6 -> Dependencia = 2;
        $unidad6 -> UnidadHabilitada = 1;
        $unidad6 -> save();

        $dependencia5 = new Dependencia();
        $dependencia5 -> idunidadPadre = 2;
        $dependencia5 -> idunidadHijo = 6;
        $dependencia5 -> save();
    }
}
