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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'TaskFighterController@home')->middleware(['web','auth']);

Route::get('/tasks', 'TaskFighterController@fetchData')->middleware(['web','auth']);

Route::get('/tick', 'TaskFighterController@tick')->middleware(['web','auth']);

Route::post('/tasks/create', 'TaskFighterController@create')->middleware(['web','auth']);

Route::delete('/tasks/delete/{id}', 'TaskFighterController@delete')->middleware(['web','auth']);


