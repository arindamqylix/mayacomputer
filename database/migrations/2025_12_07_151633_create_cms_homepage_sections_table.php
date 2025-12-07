<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsHomepageSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_homepage_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_type', 50); // counter_stat, about_us_header, about_us_item, why_choose_header, why_choose_item, service_item, achievement_header, achievement_counter, partner_item
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('video_url')->nullable();
            $table->string('icon')->nullable(); // Font Awesome icon class
            $table->string('number')->nullable(); // For counters
            $table->string('label')->nullable(); // For counters/labels
            $table->text('content')->nullable(); // JSON or HTML content for complex sections (like accordion items)
            $table->string('link')->nullable();
            $table->string('link_text')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('cms_homepage_sections');
    }
}
