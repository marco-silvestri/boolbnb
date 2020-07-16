<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('sponsorship_id');
            $table->dateTime('sponsorship_expiration')->nullable();
            $table->timestamps();

            $table->foreign('apartment_id')
                ->references('id')
                ->on('apartments');

            $table->foreign('sponsorship_id')
                ->references('id')
                ->on('sponsorships');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
