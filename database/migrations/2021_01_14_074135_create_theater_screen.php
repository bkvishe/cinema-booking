<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheaterScreen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theater_screen', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->integer('total_seats');
            $table->foreignId('theater_id');
            $table->foreign('theater_id')->references('id')->on('theater');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theater_screen');
    }
}
