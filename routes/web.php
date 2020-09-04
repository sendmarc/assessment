<?php

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

use app\Http\Controllers\TaskFighterController;
use App\TaskFighter;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', 'TaskFighterController')->name('home');

Route::post('/tasks', 'TaskFighterController')->name('create');

Route::delete('/tasks/{id}', 'TaskFighterController')->name('delete');

Route::get('/list/tick', 'TaskFighterController')->name('tick');
