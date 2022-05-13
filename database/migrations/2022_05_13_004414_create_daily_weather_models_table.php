<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyWeatherModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_weather_models', function (Blueprint $table) {
            $table->id();
            $table->string('longitude');
            $table->string('latitude');
            $table->string('timezone');
            $table->string('timezone_offset');
            $table->string('dt');
            $table->string('sunrise');
            $table->string('sunset');
            $table->string('moonrise');
            $table->string('moonset');
            $table->string('moon_phase');
            // $table->string('');
            // $table->string('');
            // $table->string('');
            // $table->string('');
            // $table->string('');
            // $table->string('');
            // $table->string('');
            // $table->string('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_weather_models');
    }
}
