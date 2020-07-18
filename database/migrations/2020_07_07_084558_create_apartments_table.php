<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
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
            $table->double('lat', 11, 8)->nullable();
            $table->double('long', 11, 8)->nullable();
            $table->string('img');
            $table->boolean('visibility')->nullable();
            $table->unsignedSmallInteger('view_count')->default(0);
            $table->datetime('sponsorship_expiration')->nullable();
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
