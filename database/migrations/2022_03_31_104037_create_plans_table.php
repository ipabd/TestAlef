<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('classst_id')->unsigned();
            $table->foreign('classst_id')->references('id')->on('classsts');
            $table->integer('lecture_id')->unsigned();
            $table->foreign('lecture_id')->references('id')->on('lectures');
            $table->integer('parent')->unsigned();
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
        Schema::dropIfExists('plans');
    }
}
