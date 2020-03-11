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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); 

Route::get('list', 'Users@list');
Route::get('list/{id}', 'Users@show');
Route::post('list', 'Users@store');
Route::put('list/{user}', 'Users@update');
Route::delete('list/{user}', 'Users@delete');