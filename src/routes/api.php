<?php

use Illuminate\Http\Request;
use App\Http\Controllers\TaskFighter\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tasks', [TaskController::class, 'index']);

Route::get('/list/tick', [TaskController::class, 'tick']);

Route::post('/tasks', [TaskController::class, 'store']);

Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
