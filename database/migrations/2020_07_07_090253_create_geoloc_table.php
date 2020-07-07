<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeolocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geoloc', function (Blueprint $table) { 
            $table->unsignedBigInteger('apartment_id');
            $table->double('lat', 10, 8);
            $table->double('long', 10, 8);

            $table->foreign('apartment_id')
                ->references('id')
                ->on('apartments');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geoloc');
    }
}
