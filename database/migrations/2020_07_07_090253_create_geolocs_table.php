<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeolocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geolocs', function (Blueprint $table) { 
            $table->unsignedBigInteger('apartment_id');
            $table->double('lat', 11, 8);
            $table->double('long', 11, 8);

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
        Schema::dropIfExists('geolocs');
    }
}
