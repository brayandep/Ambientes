<?php

namespace Database\Seeders;

use App\Models\Ambiente;
use Illuminate\Database\Seeder;

class AmbienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $table = new Ambiente();
        //$table->unsignedBigInteger('id_ambientes');
        //$table->foreign('id_ambientes')->references('id')->on('ambientes');
        $table->string('nombreTipo'); 
        $table->save();
        
        $table2 = new Ambiente();
        $table2->unsignedBigInteger('tipo_ambiente_id');
        $table2->foreign('tipo_ambiente_id')->references('id')->on('tipo_ambientes');
        $table2->string('codigo')->unique();
        $table2->string('unidad'); 
        $table2->string('nombre');
        $table2->integer('capacidad'); 
        $table2->string('ubicacion'); 
        $table2->string('descripcion_ubicacion')->nullable();
        $table2->boolean('estadoAmbiente'); 
        $table2->save();
        
        $table3 = new Ambiente();
        $table3->unsignedBigInteger('tipo_ambiente_id');
        $table3->foreign('tipo_ambiente_id')->references('id')->on('tipo_ambientes');
        $table3->unsignedBigInteger('ambiente_id');
        $table3->foreign('ambiente_id')->references('id')->on('ambientes');
        $table3->string('nombreEquipo');
        $table3->boolean('estadoEquipo'); 
        $table3->save();
        
        $table4 = new Ambiente();
        $table4->unsignedBigInteger('ambiente_id');
        $table4->foreign('ambiente_id')->references('id')->on('ambientes');
        $table4->time('horaInicio'); 
        $table4->time('horaFin');
        $table4->boolean('estadoHorario'); 
        $table4->string('dia'); 
        $table4->save();

        $table5 = new Ambiente();
        $table5->string('nombreUnidad');
        $table5->string('codigoUnidad');
        $table5->string('responsable'); 
        $table5->integer('nivel');
        $table5->string('dependencia');
        $table5->save();
    }
}
