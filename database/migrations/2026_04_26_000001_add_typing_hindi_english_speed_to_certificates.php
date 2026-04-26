<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_certificates', function (Blueprint $table) {
            if (! Schema::hasColumn('student_certificates', 'sc_typing_speed_hindi')) {
                $table->string('sc_typing_speed_hindi', 50)->nullable()->after('sc_typing_speed');
            }
            if (! Schema::hasColumn('student_certificates', 'sc_typing_speed_english')) {
                $table->string('sc_typing_speed_english', 50)->nullable()->after('sc_typing_speed_hindi');
            }
        });
    }

    public function down(): void
    {
        Schema::table('student_certificates', function (Blueprint $table) {
            if (Schema::hasColumn('student_certificates', 'sc_typing_speed_english')) {
                $table->dropColumn('sc_typing_speed_english');
            }
            if (Schema::hasColumn('student_certificates', 'sc_typing_speed_hindi')) {
                $table->dropColumn('sc_typing_speed_hindi');
            }
        });
    }
};
