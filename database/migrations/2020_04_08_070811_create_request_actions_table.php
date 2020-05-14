<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_actions', function (Blueprint $table) {
            $table->id();
           $table->unsignedBigInteger('request_id');
            $table->foreign('request_id')->references('id')->on('requests');
           // $table->unsignedBigInteger('action_id');
          //  $table->foreign('action_id')->references('id')->on('actions');
             //$table->unsignedBigInteger('transition_id');
             //$table->foreign('transition_id')->references('id')->on('transitions');
             $table->boolean('isactive');
             $table->boolean('iscomplete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_actions');
    }
}