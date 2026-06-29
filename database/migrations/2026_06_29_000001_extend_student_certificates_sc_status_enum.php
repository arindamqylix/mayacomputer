<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ExtendStudentCertificatesScStatusEnum extends Migration
{
    public function up()
    {
        DB::statement("
            ALTER TABLE `student_certificates`
            MODIFY COLUMN `sc_status` ENUM(
                'GENERATED',
                'ISSUED',
                'VERIFIED',
                'RECEIVED',
                'DISPATCHED',
                'PENDING',
                'RETURNED'
            ) NULL DEFAULT 'GENERATED'
        ");
    }

    public function down()
    {
        DB::table('student_certificates')
            ->whereIn('sc_status', ['DISPATCHED', 'PENDING', 'RETURNED'])
            ->update(['sc_status' => 'ISSUED']);

        DB::statement("
            ALTER TABLE `student_certificates`
            MODIFY COLUMN `sc_status` ENUM(
                'GENERATED',
                'ISSUED',
                'VERIFIED',
                'RECEIVED'
            ) NULL DEFAULT 'GENERATED'
        ");
    }
}
