<?php
Route::get('/', 'TaskController@index');
Route::get('/tasks', 'TaskController@tasks');
Route::post('/tasks', 'TaskController@store');
Route::get('/list/tick', 'TaskController@tick');
