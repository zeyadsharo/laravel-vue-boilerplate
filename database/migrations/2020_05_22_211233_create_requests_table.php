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
             $table->unsignedBigInteger('user_id');
             $table->foreign('user_id')->references('id')->on('users');
             $table->date('created_at');
             $table->integer('requestnumber');
             $table->string('department');
             $table->string('location');
             $table->string('problem_description');
             $table->string('priority');
             $table->string('completed_by');
             $table->string('Remarks');
             $table->date('date_completed');
              
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