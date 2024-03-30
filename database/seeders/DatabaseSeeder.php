<?php

namespace Database\Seeders;

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
        Schema::create('tipo_ambientes', function ($table) {
            $table->id();
            //$table->unsignedBigInteger('id_ambientes');
            //$table->foreign('id_ambientes')->references('id')->on('ambientes');
            $table->string('nombreTipo'); 
            $table->timestamps();
        });
        
        Schema::create('ambientes', function ($table) {
            $table->id();
            $table->unsignedBigInteger('tipo_ambiente_id');
            $table->foreign('tipo_ambiente_id')->references('id')->on('tipo_ambientes');
            $table->string('codigo')->unique();
            $table->string('unidad'); 
            $table->string('nombre');
            $table->integer('capacidad'); 
            $table->string('ubicacion'); 
            $table->string('descripcion_ubicacion')->nullable();
            $table->boolean('estadoAmbiente'); 
            $table->timestamps();
        });
        
        Schema::create('equipos', function ($table) {
            $table->id();
            $table->unsignedBigInteger('tipo_ambiente_id');
            $table->foreign('tipo_ambiente_id')->references('id')->on('tipo_ambientes');
            $table->unsignedBigInteger('ambiente_id');
            $table->foreign('ambiente_id')->references('id')->on('ambientes');
            $table->string('nombreEquipo');
            $table->boolean('estadoEquipo'); 
            $table->timestamps();
        });
        
        Schema::create('horario_disponibles', function ($table) {
            $table->id();
            $table->unsignedBigInteger('ambiente_id');
            $table->foreign('ambiente_id')->references('id')->on('ambientes');
            $table->time('horaInicio'); 
            $table->time('horaFin');
            $table->boolean('estadoHorario'); 
            $table->string('dia'); 
            $table->timestamps();
        });

        Schema::create('unidads', function ($table) {
            $table->id();
            $table->string('nombreUnidad');
            $table->string('codigoUnidad');
            $table->string('responsable'); 
            $table->integer('nivel');
            $table->string('dependencia');
            $table->timestamps();
        });
        
    }
}
