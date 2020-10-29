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

Route::get('/tasks/{id}', [TaskController::class, 'edit']);

Route::get('/list/tick', [TaskController::class, 'tick']);

Route::post('/tasks/store', [TaskController::class, 'store']);

Route::put('/tasks/update/{id}', [TaskController::class, 'update']);

Route::delete('/tasks/delete/{id}', [TaskController::class, 'destroy']);
