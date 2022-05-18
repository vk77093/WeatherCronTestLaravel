<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
use App\Http\Controllers\OpenWeatherFetchCont;

Route::get("/weather",[OpenWeatherFetchCont::class,'GetWeatherAPI']);

Route::get("/weathercrul",[OpenWeatherFetchCont::class,'getWeatherDataByCrul']);

Route::get("/latadd",[OpenWeatherFetchCont::class,'AddWeatherData']);

Route::get("/date",[OpenWeatherFetchCont::class,'ConverVertNumberTodateTest']);

Route::get("/cities",[OpenWeatherFetchCont::class,'getAllCities']);

Route::get("/checkcount",[OpenWeatherFetchCont::class,'checkCountWeather']);
/*api creation for the current weather data 
 */
use App\Http\Controllers\WeatherApi\WeatherApiController;
Route::get("/currentweather",[WeatherApiController::class,'index']);