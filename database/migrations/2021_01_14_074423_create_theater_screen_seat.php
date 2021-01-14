<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheaterScreenSeat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theater_screen_seat', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->integer('seat_number');
            $table->string('type', 16);
            $table->foreignId('theater_screen_id');
            $table->foreign('theater_screen_id')->references('id')->on('theater_screen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theater_screen_seat');
    }
}
