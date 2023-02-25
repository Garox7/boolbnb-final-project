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

// Rotte pubbliche
Route::post('/register', 'Api\AuthController@register');
Route::get('/properties', 'Api\PropertyController@index');
Route::get('/properties/{property}', 'Api\PropertyController@show');

// Rotte protette
Route::middleware('auth:sanctum')
->group(function () {
    Route::post('/logout', 'Api\AuthController@logout');
    Route::post('/properties', 'Api\PropertyController@store');
    Route::put('/properties/{property}', 'Api\PropertyController@update');
    Route::delete('/properties/{property}', 'Api\PropertyController@destroy');

});

// si può scrivere anche così
// Route::group(['middleware' => ['auth:sanctum']],function () {
//     Route::resource('properties', 'Api\PropertyController');
// });
