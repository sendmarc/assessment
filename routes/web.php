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

Route::get('/', function() {
    return redirect('/api/v1/tasks');
});

Route::get('/api/v1/tasks', 'Task@getAllTasks');
Route::post('/api/v1/tasks', 'Task@createTask');
Route::delete('/api/v1/tasks/{id}', 'Task@deleteTask');
Route::get('api/v1/tasks/tick', 'Task@tick');