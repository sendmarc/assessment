<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskFighter;
use Illuminate\Http\Request;
use Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task;
       // Log::info($request);
        $task->name = $request->input('name');
        $task->priority = $request->input('priority');
        $task->dueIn = $request->dueIn;
        $task->save();

        return 'Successfully saved!';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();
        return 'Task sucessfully deleted!';

    }

    public function tick()
    {
        $tasks = Task::all();
        foreach($tasks as $task)
        {
            $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);
            $taskFighter->tick();
            $task->priority = $taskFighter->priority;
            $task->dueIn = $taskFighter->dueIn;
            $task->save();
        }
        return 'tick';
    }
}
