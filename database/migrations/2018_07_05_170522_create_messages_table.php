<?php

use App\Message;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('uid');
            $table->string('sender');
            $table->string('subject');
            $table->string('message');
            $table->dateTime('time_sent');
            $table->enum('status', [Message::STATUS_UNREAD, Message::STATUS_READ]);
            $table->boolean('isArchived');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
