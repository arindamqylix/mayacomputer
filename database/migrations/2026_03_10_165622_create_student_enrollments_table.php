<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_enrollments', function (Blueprint $table) {
            $table->id('se_id');
            $table->integer('se_FK_of_student_id');
            $table->integer('se_FK_of_course_id');
            $table->integer('se_FK_of_center_id');
            $table->string('se_status')->default('VERIFIED'); // PENDING, VERIFIED, COMPLETED, etc.
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
        Schema::dropIfExists('student_enrollments');
    }
}
