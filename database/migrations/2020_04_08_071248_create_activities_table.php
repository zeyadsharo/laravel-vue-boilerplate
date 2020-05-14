<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
             $table->id();
             $table->unsignedBigInteger('activity_type_id');
           //  $table->foreign('activity_type_id')->references('id')->on('activity_types');
             $table->unsignedBigInteger('process_id');
             //$table->foreign('process_id')->references('id')->on('processes');
               $table->string("name");
               $table->string("description");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}