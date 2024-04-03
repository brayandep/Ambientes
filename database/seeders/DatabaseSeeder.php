<?php

namespace Database\Seeders;

use App\Models\Materia;
use App\Models\Unidad;
use App\Models\TipoAmbiente;
use App\Models\Ambiente;
use App\Models\Equipo;
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
        //$this->call(Materia::class);
        // \App\Models\User::factory(10)->create();
        /*Schema::create('tipo_ambientes', function ($table) {
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

        Schema::create('unidades', function ($table) {
            $table->id();
            $table->string('nombreUnidad');
            $table->string('codigoUnidad');
            $table->string('responsable'); 
            $table->integer('nivel');
            $table->string('dependencia');
            $table->timestamps();
        });
        */
        TipoAmbiente::create(['nombreTipo' => 'Aula']);
        TipoAmbiente::create(['nombreTipo' => 'Auditorio']);
        TipoAmbiente::create(['nombreTipo' => 'Sala común']);
        // Agrega más tipos de ambientes si es necesario

        // Seeders para Ambiente
        Ambiente::create([
            'tipo_ambiente_id' => 1,
            'codigo' => 'A002',
            'unidad' => 'Unidad 1',
            'nombre' => 'Ambiente 1',
            'capacidad' => 10,
            'ubicacion' => 'Ubicación 1',
            'descripcion_ubicacion' => 'Descripción Ubicación 1',
            'estadoAmbiente' => true,
        ]);

        Ambiente::create([
            'tipo_ambiente_id' => 1,
            'codigo' => 'A001',
            'unidad' => 'Unidad 1',
            'nombre' => 'Aula 692',
            'capacidad' => 10,
            'ubicacion' => 'Ubicación 1',
            'descripcion_ubicacion' => 'Descripción Ubicación 1',
            'estadoAmbiente' => true,
        ]);
        // Agrega más ambientes si es necesario

        // Seeders para Equipo
        Equipo::create([
            'tipo_ambiente_id' => 1,
            'ambiente_id' => null,
            'nombreEquipo' => 'Data-Display',
            'estadoEquipo' => true,
        ]);
        Equipo::create([
            'tipo_ambiente_id' => 1,
            'ambiente_id' => null,
            'nombreEquipo' => 'Sillas',
            'estadoEquipo' => true,
        ]);

        Equipo::create([
            'tipo_ambiente_id' => 1,
            'ambiente_id' => null,
            'nombreEquipo' => 'Router',
            'estadoEquipo' => true,
        ]);
        Equipo::create([
            'tipo_ambiente_id' => 1,
            'ambiente_id' => null,
            'nombreEquipo' => 'Mikrotik',
            'estadoEquipo' => true,
        ]);
        Equipo::create([
            'tipo_ambiente_id' => 1,
            'ambiente_id' => null,
            'nombreEquipo' => 'Televisor',
            'estadoEquipo' => true,
        ]);
        Equipo::create([
            'tipo_ambiente_id' => 1,
            'ambiente_id' => null,
            'nombreEquipo' => 'Computadoras',
            'estadoEquipo' => true,
        ]);
        Equipo::create([
            'tipo_ambiente_id' => 1,
            'ambiente_id' => null,
            'nombreEquipo' => 'Pizarra',
            'estadoEquipo' => true,
        ]);
        /*Unidad::create([
            'nombreUnidad' => 'Facultad',
            'codigoUnidad' => 12345,
            'Responsable' => 'Nombre del responsable 1',
            'Nivel' => 1,
            'Dependencia' => 'Dependencia 1',
        ]);

        Unidad::create([
            'nombreUnidad' => 'Nombre de la unidad 2',
            'codigoUnidad' => 67890,
            'Responsable' => 'Nombre del responsable 2',
            'Nivel' => 2,
            'Dependencia' => 'Dependencia 2',
        ]);*/
    }
    
}
