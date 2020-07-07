<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->id();
            $table->float('price', 3, 2);
            $table->timestamps();//Sarebbe la data?
            $table->unsignedTinyInteger('sponsorship_duration');

            $table->foreign('user_id')
                ->references('user_id')
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
        Schema::dropIfExists('payments');
    }
}
