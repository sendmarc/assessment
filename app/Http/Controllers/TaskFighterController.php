<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Http\Resources\TaskResource;
use App\TaskFighter;
use Illuminate\Http\Request;

class TaskFighterController extends Controller
{
    public function index()
    {
        return TaskResource::collection(
            TaskFighter::all()
        );
    }

    public function store(CreateTaskRequest $request)
    {
        $task = TaskFighter::create($request->only([
            'name', 'priority', 'dueIn'
        ]));

        return new TaskResource($task);
    }

    public function destroy(TaskFighter $task)
    {
        $task->delete();

        return new TaskResource($task);
    }

    public function tick()
    {
        $tasks = TaskFighter::all();
        
        $message = 'Done ticking...';

        if(!$tasks->count()) {
            $message = 'Nothing to tick';
        }
        else {
            $tasks->each(function(TaskFighter $task) {
                $task->tick();
                $task->save();
            });
        }

        return response()->json(['message' => $message]);
    }
}
