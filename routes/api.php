<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// get /tweets -> devuelve todos los tweets
// get /tweets/username -> devuelve todos los tweets de un usuario
//Route::get('/tweets/{username}', 'App\Http\Controllers\ApiController@tweets')->name('tweets');
