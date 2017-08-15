<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllocateClassRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocate_class_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('room_no_id')->unsigned();
            $table->integer('day_id')->unsigned();
            $table->time('start_time');
            $table->string('start_time_radio');
            $table->time('end_time');
            $table->string('end_time_radio');
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('room_no_id')->references('id')->on('room_nos');
            $table->foreign('day_id')->references('id')->on('days');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allocate_class_rooms');
    }
}
