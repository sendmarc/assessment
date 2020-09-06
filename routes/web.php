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
Auth::routes();

Route::get('/', 'TaskFighterController@home');

Route::get('/tasks', 'TaskFighterController@fetchData');

Route::get('/tick', 'TaskFighterController@tick');

Route::post('/tasks', 'TaskFighterController@create');

Route::delete('/tasks/{id}', 'TaskFighterController@delete');

Route::get('/list/tick', 'TaskFighterController@tick');

Route::get('/home', 'HomeController@index')->name('home');
