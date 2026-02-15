<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Change drr_document_type from ENUM to VARCHAR so we can store
     * any document type name from document_types.dt_name (e.g. "I Card Print", "Admit Card").
     */
    public function up()
    {
        DB::statement("ALTER TABLE document_reissue_requests MODIFY drr_document_type VARCHAR(255) NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::statement("ALTER TABLE document_reissue_requests MODIFY drr_document_type ENUM('CERTIFICATE', 'MARKSHEET', 'ID_CARD') NOT NULL");
    }
};
