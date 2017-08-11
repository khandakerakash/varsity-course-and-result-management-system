<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_name');
            $table->string('student_email')->unique();
            $table->integer('student_contact_no')->unique();
            $table->date('student_reg_date');
            $table->string('student_address');
            $table->integer('department_id')->unsigned();
            $table->string('registration_number');
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_students');
    }
}
