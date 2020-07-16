<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentOptionTable extends Migration
{
    public function up()
    {
        Schema::create('apartment_option', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('apartment_id');
            
            $table->foreign('option_id')
                ->references('id')
                ->on('options');

            $table->foreign('apartment_id')
                ->references('id')
                ->on('apartments');
        });
    }

    public function down()
    {
        Schema::dropIfExists('apartment_option');
    }
}
