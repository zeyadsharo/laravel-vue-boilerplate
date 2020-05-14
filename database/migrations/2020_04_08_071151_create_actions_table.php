<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('actiontype_id');
           //  $table->foreign('actiontype_id')->references('id')->on('action_types');
             $table->unsignedBigInteger('process_id');
            // $table->foreign('process_id')->references('id')->on('processes');
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
        Schema::dropIfExists('actions');
    }
}