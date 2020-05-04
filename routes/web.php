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
    return redirect('/tasks');
});
Route::resource('/','TaskFighterController');
Route::get('/tasks/{id}','TaskFighterController@destroy');


Route::get('/list/tick', function() {
    $tasks = DB::table('tasks')->select('*')->get();
    foreach ($tasks as $task) {
        $taskFighter = new \App\TaskFighter($task->name, $task->priority, $task->dueIn);
        $taskFighter->tick();
        DB::update("update tasks set priority = '{$taskFighter->priority}', dueIn = '{$taskFighter->dueIn}' where id = '{$task->id}'");
    }
    return 'tick';
});
