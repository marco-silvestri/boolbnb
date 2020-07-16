<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorshipsTable extends Migration
{
    public function up()
    {
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->id();
            $table->float('price', 3 , 2);
            $table->unsignedTinyInteger('duration');
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sponsorships');
    }
}
