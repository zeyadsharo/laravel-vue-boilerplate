<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
              $table->string("name");
              $table->string("description");
              $table->unsignedBigInteger('process_id');
             //$table->foreign('process_id')->references('id')->on('processes');
               $table->unsignedBigInteger('state_type_id');
               //$table->foreign('state_type_id')->references('id')->on('state_types');
              
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}