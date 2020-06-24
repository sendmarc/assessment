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


Route::get('/', 'TaskController@indexview');

Route::get('/tasks', 'TaskController@index');

Route::post('/tasks', 'TaskController@store');

Route::delete('/tasks/{id}', 'TaskController@destroy');

Route::get('/list/tick', 'TaskController@tick');
