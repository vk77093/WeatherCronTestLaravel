<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLatModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lat_models', function (Blueprint $table) {
            $table->id();
            $table->string('longitude');
            $table->string('latitude');
            $table->string('timezone');
            $table->string('timezone_offset');
            $table->string('currentDt');
            $table->string('Current_sunrise');
            $table->string('Current_sunset');
            $table->string('Current_temp');
            $table->string('Current_feels_like');
            $table->string('Current_pressure');
            $table->string('Current_humidity');
            $table->string('Current_dew_point');
            $table->string('Current_uvi');
            $table->string('Current_clouds');
            $table->string('Current_visibility');
            $table->string('Current_wind_speed');
            $table->string('Current_wind_deg');
             $table->string('weather_id');
             $table->string('weather_main');
             $table->string('weather_description');
             $table->string('weather_icon');
            //  $table->string('weather_');
            //  $table->string('weather_');
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
        Schema::dropIfExists('lat_models');
    }
}
