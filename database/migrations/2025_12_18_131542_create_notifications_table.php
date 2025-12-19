<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('user_type', ['student_login', 'center_login', 'admin_login'])->comment('Type of user receiving notification');
            $table->unsignedBigInteger('user_id')->comment('ID of user receiving notification');
            $table->string('type')->comment('Type of notification (e.g., chat_message, system, etc.)');
            $table->string('title');
            $table->text('message');
            $table->string('link', 500)->nullable()->comment('Optional link to related page');
            $table->boolean('is_read')->default(0)->comment('0=unread, 1=read');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['user_type', 'user_id'], 'idx_user');
            $table->index('is_read', 'idx_read_status');
            $table->index('created_at', 'idx_created');
            $table->index('type', 'idx_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
