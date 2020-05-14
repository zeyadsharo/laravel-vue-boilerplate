<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_targets', function (Blueprint $table) {
            $table->id();
           
            $table->unsignedBigInteger('activity_id');
            // $table->foreign('activity_id')->references('id')->on('activities');
           
            $table->unsignedBigInteger('target_id');
             // $table->foreign('target_id')->references('id')->on('targets');
             $table->unsignedBigInteger('group_id');
             // $table->foreign('group_id')->references('id')->on('groups');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_targets');
    }
}