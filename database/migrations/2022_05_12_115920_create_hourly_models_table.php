<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHourlyModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hourly_models', function (Blueprint $table) {
            $table->id();
            $table->string('longitude');
            $table->string('latitude');
            $table->string('timezone');
            $table->string('timezone_offset');
            $table->string('dt');
            $table->string('temp');
            $table->string('feels_like');
            $table->string('pressure');
            $table->string('humidity');
            $table->string('dew_point');
            $table->string('uvi');
            $table->string('clouds');
            $table->string('visibility');
            $table->string('wind_speed');
            $table->string('wind_deg');
            $table->string('wind_gust');
            $table->string('weather_id');
            $table->string('main');
            $table->string('description');
            $table->string('icon');
           
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
        Schema::dropIfExists('hourly_models');
    }
}
