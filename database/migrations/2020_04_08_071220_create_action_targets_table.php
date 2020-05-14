<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_targets', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('action_id');
            // $table->foreign('action_id')->references('id')->on('actions');
              $table->unsignedBigInteger('target_id');
           //  $table->foreign('target_id')->references('id')->on('targets');
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
        Schema::dropIfExists('action_targets');
    }
}