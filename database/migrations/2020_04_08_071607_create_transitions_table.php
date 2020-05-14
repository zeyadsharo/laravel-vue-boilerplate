<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_id');
          //  $table->foreign('process_id')->references('id')->on('processes');
            $table->unsignedBigInteger('current_state_id');
         //   $table->foreign('current_state_id')->references('id')->on('states');
            $table->unsignedBigInteger('next_state_id');
           // $table->foreign('next_state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transitions');
    }
}