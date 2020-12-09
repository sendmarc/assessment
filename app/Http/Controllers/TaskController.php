<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Task;
use App\TaskFighter;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Tasks';
        $tasks = Task::orderBy('priority', 'desc')->get();
        return view('tasks.index', compact('title', 'tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TaskRequest $request)
    {
        try {
            $task = Task::create($request->all());
        } catch (\Exception $e) {
            report($e);
            return response()->json(array('code' => 500, 'message' => $e), 500);
        }
        return response()->json(array('code' => 200, 'message' => 'Task created!'));
    }

    /**
     * Run the tick command.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try {
            $tasks = Task::all();

            foreach ($tasks as $task) {
                $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);
                $taskFighter->tick();
                $task->update(['name' => $taskFighter->name, 'priority' => $taskFighter->priority, 'dueIn' => $taskFighter->dueIn]);
            }
        } catch (\Exception $e) {
            report($e);
            return response()->json(array('code' => 500, 'message' => $e));
        }
        return response()->json(array('code' => 200, 'message' => 'Tick completed!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Task $task)
    {
        try {
            $task = Task::find($task->id);
            if ($task) {
                $task->delete();
            }
        } catch (\Exception $e) {
            report($e);
            return response()->json(array('code' => 500, 'message' => $e));
        }
        return response()->json(array('code' => 200, 'message' => 'Task deleted!'));
    }
}
