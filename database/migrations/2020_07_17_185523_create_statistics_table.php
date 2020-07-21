<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->bigIncrement('id');
            $table->unsignedBigInteger('Views');
            $table->unsignedBigInteger('messages');
            $table->timestamps();

            $table->foreign('apartment_id')
                ->references('id')
                ->on('apartments');

            $table->foreign('message_id')
                ->references('id')
                ->on('messages');
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
        Schema::dropIfExists('statistics');
    }
}
