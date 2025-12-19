<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conversation_id');
            $table->enum('sender_type', ['student_login', 'center_login', 'admin_login'])->comment('Type of sender');
            $table->unsignedBigInteger('sender_id')->comment('ID of sender');
            $table->text('message');
            $table->boolean('is_read')->default(0)->comment('0=unread, 1=read');
            $table->timestamps();

            $table->foreign('conversation_id')->references('id')->on('chat_conversations')->onDelete('cascade');
            $table->index('conversation_id', 'idx_conversation');
            $table->index(['sender_type', 'sender_id'], 'idx_sender');
            $table->index('is_read', 'idx_read_status');
            $table->index('created_at', 'idx_created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_messages');
    }
}
