<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 50);
            $table->text('description');
            $table->string('slug');
            $table->unsignedTinyInteger('room_numbers');
            $table->unsignedTinyInteger('bathrooms');
            $table->unsignedTinyInteger('beds');
            $table->unsignedSmallInteger('square_meters');
            $table->text('address');
            //$table->/////img
            $table->boolean('visibility');
            //$table->//////Mettere il timestamp sponsorship
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
