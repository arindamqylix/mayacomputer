<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('section')->nullable(); // history, mission, vision
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('video_url')->nullable(); // for vision section video
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
        Schema::dropIfExists('cms_about_us');
    }
}
