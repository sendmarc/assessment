<?php

namespace App\Http\Controllers\TaskFighter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
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
        $tasks = Task::paginate(5);
        return $tasks;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        return $task;
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->priority = $request->priority;
        $task->dueIn = $request->dueIn;
        $task->save();

        return 'Created!';
    }

    /**
    * Get the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $task = Task::find($id);
        return $task;
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
        $task = Task::find($id);

        if ($request->has('name')) $task->name = $request->name;
        if ($request->has('priority')) $task->priority = $request->priority;
        if ($request->has('dueIn')) $task->dueIn = $request->dueIn;

        $task->save();

        return 'Updated!';
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return 'Deleted!';
    }

    /**
    * Cause a tick
    *
    * @return \Illuminate\Http\Response
    */
    public function tick()
    {
        $tasks = Task::all();
        foreach ($tasks as $task) {
            $taskFighter = new \App\TaskFighter($task->name,$task->priority,$task->dueIn);
            $taskFighter->tick();

            $request = new \Illuminate\Http\Request([
                'id' => $task->id,
                'priority' => $taskFighter->priority,
                'dueIn' => $taskFighter->dueIn,
            ]);

            $this->update($request, $task->id);
        }

        return 'Done!';
    }
}
