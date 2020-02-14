<?php

use Illuminate\Http\Request;

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

Route::post('/task/create', 'TaskController@store');
Route::get('/task/edit/{id}', 'TaskController@edit');
Route::post('/task/update/{id}', 'TaskController@update');
Route::post('/list/tick/{id}', 'TaskController@tick');
Route::delete('/task/delete/{id}', 'TaskController@delete');
Route::get('/tasks', 'TaskController@index');