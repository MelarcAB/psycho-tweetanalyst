<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//homecontroller -> index
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/tweets/{username}', 'App\Http\Controllers\ApiController@tweets')->name('tweets');
Route::post('/gpt', 'App\Http\Controllers\ApiController@analisisGpt')->name('gpt');
