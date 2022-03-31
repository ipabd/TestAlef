<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassstLectureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classst_lecture', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('classst_id')->unsigned();
            $table->foreign('classst_id')->references('id')->on('classsts');
            $table->integer('lecture_id')->unsigned();
            $table->foreign('lecture_id')->references('id')->on('lectures');
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
        Schema::dropIfExists('classst_lecture');
    }
}
