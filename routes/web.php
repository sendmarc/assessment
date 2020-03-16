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

//The other code was moved to api.php
//The following may help to serve the vue view

Route::get('/', function() {
    return View('welcome'); //Change welcome to have the interface
});
