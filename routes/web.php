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

Route::get('/', 'TaskFighter\TaskFighterController@home');

Route::get('/tasks', 'TaskFighter\TaskFighterController@fetchData');

Route::post('/tasks', 'TaskFighter\TaskFighterController@create');

Route::delete('/tasks/{id}', 'TaskFighter\TaskFighterController@delete');

Route::get('/list/tick', 'TaskFighter\TaskFighterController@tick');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
