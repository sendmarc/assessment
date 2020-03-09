<?php
Route::get('/', 'TaskController@index');
Route::resource('/task', 'TaskController', [
    'only' => ['index', 'store', 'destroy']
]);
Route::get('/list/tick', 'TaskController@tick');
