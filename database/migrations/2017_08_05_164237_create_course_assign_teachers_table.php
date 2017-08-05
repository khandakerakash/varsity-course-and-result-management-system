<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseAssignTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_assign_teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->float('credit_taken', 2, 1);
            $table->float('remaining_credit', 2, 1);
            $table->integer('course_id')->unsigned();
            $table->string('course_name');
            $table->string('course_credit');

            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('course_id')->references('id')->on('courses');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_assign_teachers');
    }
}
