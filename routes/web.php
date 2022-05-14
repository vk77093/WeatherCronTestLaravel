<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
use Illuminate\Support\Facades\Log;
Route::get('/logs', function () {
    Log::channel('custom_error')->error('Something happened erros!');
    Log::channel('custom_debug')->info('Something happened debugs!');
    return view('welcome');
});
