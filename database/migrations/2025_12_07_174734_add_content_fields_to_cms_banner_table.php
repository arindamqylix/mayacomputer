<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContentFieldsToCmsBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms_banner', function (Blueprint $table) {
            $table->string('header')->nullable()->after('file');
            $table->text('short_description')->nullable()->after('header');
            $table->string('button_name')->nullable()->after('short_description');
            $table->string('button_url')->nullable()->after('button_name');
            $table->integer('sort_order')->default(0)->after('button_url');
            $table->boolean('status')->default(1)->after('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms_banner', function (Blueprint $table) {
            $table->dropColumn(['header', 'short_description', 'button_name', 'button_url', 'sort_order', 'status']);
        });
    }
}
