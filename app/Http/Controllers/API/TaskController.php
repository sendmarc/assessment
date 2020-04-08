<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;
use App\TaskFighter;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks = Task::all();
        return $tasks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Update tasks priorty and dueIn
     *
     */
    public function tick()
    {
        $taskFighter = new TaskFighter();
        $tasks = Task::all();

        foreach ($tasks as $task) {
            $priority = $taskFighter->tick($task->name, $task->priority, $task->dueIn)['priority'];
            $dueIn = $taskFighter->tick($task->name, $task->priority, $task->dueIn)['dueIn'];

            //update tasks table
            Task::where("id", 3)->update(["priority" => $priority, "dueIn" => $dueIn]);
        }
        
    }
}
