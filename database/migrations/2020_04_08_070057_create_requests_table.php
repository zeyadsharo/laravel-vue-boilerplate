<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
           $table->unsignedBigInteger('processes_id');
          // $table->foreign('processes_id')->references('id')->on('users');
           $table->string("title");
           $table->date("datarequest");
           $table->unsignedBigInteger('user_id');
          // $table->foreign('user_id')->references('id')->on('users');
           $table->string('username');
           $table->foreignId('currentstateid');
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
        Schema::dropIfExists('requests');
    }
}