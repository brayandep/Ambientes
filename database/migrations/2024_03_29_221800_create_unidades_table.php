<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   /**es unidads porque como el modelo se llama Unidad,los proximos registros solo aumentara una s y serian unidads*/
        Schema::create('unidade
        s', function (Blueprint $table) {
            $table->id();
            $table->string('nombreUnidad');
            $table->integer('codigoUnidad');
            $table->string('Responsable');
            $table->integer('Nivel');
            $table->string('Dependencia');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidades');
    }
}
