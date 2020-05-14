<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_id');

           // $table->foreign('request_id')->references('id')->on('requests');
            
            $table->unsignedBigInteger('user_id');

           // $table->foreign('user_id')->references('id')->on('users');
            
            $table->date("dateuploded");
            $table->string("filename");
            $table->string("filecontect");
            $table->string("mimetype");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_files');
    }
}