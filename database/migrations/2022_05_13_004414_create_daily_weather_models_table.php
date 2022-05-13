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
            $table->string('temp_day');
            $table->string('min');
            $table->string('max');
            $table->string('night');
            $table->string('eve');
            $table->string('morn');
            $table->string('feels_like_day');
            $table->string('feels_like_night');
             $table->string('feels_like_eve');
            $table->string('feels_like_morn');
            $table->string('pressure');
            $table->string('humidity');
            $table->string('dew_point');
            $table->string('wind_speed');
            $table->string('wind_deg');
            $table->string('wind_gust');
            $table->string('weather_id');
            $table->string('main');
             $table->string('description');
            $table->string('icon');
            $table->string('clouds');
            $table->string('pop');
            // $table->string('rain');
            $table->string('uvi');
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
