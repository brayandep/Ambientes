<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('IdunidadPadre')->nullable();
            $table->foreign('IdunidadPadre')
                  ->references('id')->on('unidades')
                  ->onDelete('set null');


            $table->unsignedBigInteger('IdunidadHijo')->nullable();
            $table->foreign('IdunidadHijo')
                  ->references('id')->on('unidades')
                  ->onDelete('set null');

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
        Schema::dropIfExists('dependencias');
    }
}
