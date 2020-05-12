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


Route::get('/tasks', function () {
    return view('tasks.tasks');
});
Route::redirect('/', '/tasks');
Route::prefix('api')->group(function() {
    Route::resource('tasks', 'TaskFighterController');
    Route::get('/tasks','TaskFighterController@index')->name('tasks');
    Route::get('/list/tick','TaskFighterController@tickItem');
    Route::get('/deleteTask/{id}','TaskFighterController@destroy');

});

