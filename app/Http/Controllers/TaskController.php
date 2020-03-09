<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\CreateTask;
use App\Models\Task;
use App\TaskFighter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $tasks = Task::all();

        return view('index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTask $request
     *
     * @return JsonResponse
     */
    public function store(CreateTask $request): JsonResponse
    {

        $task = new Task;
        $task->name = $request->name;
        $task->priority = $request->priority;
        $task->dueIn = $request->dueIn;
        $status =  $task->save();
        if($status){
            $message = 'Task Created';
        }else{
            $message = 'Task not created';
        }

        return \response()->json(['status' => $status, 'message' => $message, 'tasks' => Task::all()->toArray()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return string
     */
    public function destroy($id): string
    {
        try{
            $task = Task::findOrFail($id);
            $task->delete();
            $status = true;
            $message = 'Task Deleted';
        }catch (ModelNotFoundException $e){
            $status = false;
            $message = $e->getMessage();
        }

        return response()->json(['status' => $status, 'message' => $message, 'tasks' => Task::all()->toArray()])->getContent();
    }


    public function tick(): string
    {
        $tasks = Task::all();
        $tasks->map(static function (Task $task){
            /** @var TaskFighter $taskFighter */
            $taskFighter = TaskFighter::of($task->name, $task->priority, $task->dueIn);
            $taskFighter->tick();
            $task->update([
                'priority' => $taskFighter->priority,
                'dueIn' => $taskFighter->dueIn
            ]);

        });

        return \response()->json(['status' => true, 'message' => 'Task ticked', 'tasks' => Task::all()])->getContent();
    }
}
