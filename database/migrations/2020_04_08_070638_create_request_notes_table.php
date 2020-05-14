<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_id');
           // $table->foreign('request_id')->references('id')->on('requests');
            $table->unsignedBigInteger('user_id');
           // $table->foreign('user_id')->references('id')->on('users');
            $table->string("note");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_notes');
    }
}