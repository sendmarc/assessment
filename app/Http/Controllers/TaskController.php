<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\CreateTask;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\TaskFighter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{

    public function home()
    {

        return view('index');
    }

    public function tick(): AnonymousResourceCollection
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

        return $this->index();
    }
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTask $request
     *
     * @return TaskResource
     */
    public function store(CreateTask $request): TaskResource
    {
        $task = Task::create([
                'name' => $request->name,
                'priority' => $request->priority,
                'dueIn' => $request->dueIn,
            ]);
        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     *
     * @return TaskResource
     */
    public function show(Task $task): TaskResource
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Task    $task
     *
     * @return TaskResource
     */
    public function update(CreateTask $request, Task $task): TaskResource
    {
        $task->update($request->only([
            'name',
            'priority',
            'dueIn'
        ]));

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json(null, 204);
    }

}
