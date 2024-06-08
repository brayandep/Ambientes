<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('event_type');
            //$table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_id')->nullable();
            
            $table->text('old_data')->nullable();
            
            $table->text('new_data')->nullable();
            $table->string('tabla_afectada'); 
            $table->string('id_afectado'); 
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
        Schema::dropIfExists('logs');
    }
}
