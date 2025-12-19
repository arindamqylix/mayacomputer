<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_conversations', function (Blueprint $table) {
            $table->id();
            $table->enum('participant_one_type', ['student_login', 'center_login', 'admin_login'])->comment('Type of first participant');
            $table->unsignedBigInteger('participant_one_id')->comment('ID of first participant');
            $table->enum('participant_two_type', ['student_login', 'center_login', 'admin_login'])->comment('Type of second participant');
            $table->unsignedBigInteger('participant_two_id')->comment('ID of second participant');
            $table->timestamp('last_message_at')->nullable()->comment('Timestamp of last message');
            $table->timestamps();

            $table->index(['participant_one_type', 'participant_one_id'], 'idx_participant_one');
            $table->index(['participant_two_type', 'participant_two_id'], 'idx_participant_two');
            $table->index('last_message_at', 'idx_last_message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_conversations');
    }
}
