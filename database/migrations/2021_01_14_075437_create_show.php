<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->foreignId('theater_screen_id');
            $table->foreign('theater_screen_id')->references('id')->on('theater_screen');
            $table->foreignId('film_id');
            $table->foreign('film_id')->references('id')->on('film');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('show');
    }
}
