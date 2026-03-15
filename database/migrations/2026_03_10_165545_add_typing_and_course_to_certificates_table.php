<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypingAndCourseToCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_certificates', function (Blueprint $table) {
            $table->integer('sc_FK_of_course_id')->nullable()->after('sc_FK_of_center_id');
            $table->enum('sc_type', ['REGULAR', 'TYPING'])->default('REGULAR')->after('sc_status');
            $table->string('sc_typing_speed')->nullable()->after('sc_type');
            $table->string('sc_typing_accuracy')->nullable()->after('sc_typing_speed');
        });

        Schema::table('set_result', function (Blueprint $table) {
            $table->integer('sr_FK_of_course_id')->nullable()->after('sr_FK_of_center_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_certificates', function (Blueprint $table) {
            $table->dropColumn(['sc_FK_of_course_id', 'sc_type', 'sc_typing_speed', 'sc_typing_accuracy']);
        });

        Schema::table('set_result', function (Blueprint $table) {
            $table->dropColumn('sr_FK_of_course_id');
        });
    }
}
