<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCorporateAddressAndSocialFieldsToSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('site_settings', 'corporate_address')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->text('corporate_address')->nullable()->after('address');
            });
        }
        if (!Schema::hasColumn('site_settings', 'facebook')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->string('facebook')->nullable()->after('copyright');
            });
        }
        if (!Schema::hasColumn('site_settings', 'twitter')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->string('twitter')->nullable()->after('facebook');
            });
        }
        if (!Schema::hasColumn('site_settings', 'instagram')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->string('instagram')->nullable()->after('twitter');
            });
        }
        if (!Schema::hasColumn('site_settings', 'youtube')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->string('youtube')->nullable()->after('instagram');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['corporate_address', 'facebook', 'twitter', 'instagram', 'youtube']);
        });
    }
}

