<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestStakeHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_stake_holders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_id');
           // $table->foreign('request_id')->references('id')->on('requests');
            $table->unsignedBigInteger('user_id');
           // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_stake_holders');
    }
}