<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowSeat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_seat', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['taken', 'available']);
            $table->float('price');
            $table->foreignId('theater_screen_seat_id');
            $table->foreign('theater_screen_seat_id')->references('id')->on('theater_screen_seat');
            $table->foreignId('show_id');
            $table->foreign('show_id')->references('id')->on('show');
            $table->foreignId('booking_id');
            $table->foreign('booking_id')->references('id')->on('booking');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('show_seat');
    }
}
