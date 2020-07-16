<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apartment_id');
            $table->string('email');
            $table->string('title', 100);
            $table->text('body');
            $table->timestamps();

            $table->foreign('apartment_id')
                ->references('id')
                ->on('apartments');
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
