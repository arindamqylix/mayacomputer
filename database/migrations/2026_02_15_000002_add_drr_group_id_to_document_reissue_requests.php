<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Group multiple document reissue requests for one-time payment.
     */
    public function up()
    {
        Schema::table('document_reissue_requests', function (Blueprint $table) {
            $table->string('drr_group_id', 64)->nullable()->after('drr_FK_of_student_id');
            $table->index('drr_group_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('document_reissue_requests', function (Blueprint $table) {
            $table->dropIndex(['drr_group_id']);
            $table->dropColumn('drr_group_id');
        });
    }
};
