<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_data', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('request_id');
             $table->foreign('request_id')->references('id')->on('requests');
             $table->string("name");
             $table->string("value");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_data');
    }
}