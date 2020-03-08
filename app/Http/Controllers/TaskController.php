<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\CreateTask;
use App\Task;
use App\TaskFighter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
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
        $tasks = $this->tasks();
        return view('index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(CreateTask $request): ?Response
    {

        $task = new Task;
        $task->name = $request->name;
        $task->priority = $request->priority;
        $task->dueIn = $request->dueIn;
        $task->save(['name' => $request->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return void
     */
    public function destroy($id): void
    {
        $task = Task::findOrFail($id);
        if($task){
            $task->delete();

        }
    }

    /**
     * Display the specified resource.
     *
     * @return Task[]|Collection
     */
    public function tasks()
    {
        return Task::all();
    }

    public function tick(): string
    {
        $tasks = $this->tasks();
        $tasks->map(static function (Task $task){
            /** @var TaskFighter $taskFighter */
            $taskFighter = TaskFighter::of($task->name, $task->priority, $task->dueIn);
            $taskFighter->tick();
            $task->update([
                'priority' => $taskFighter->priority,
                'dueIn' => $taskFighter->dueIn
            ]);
        });
        //TODO: Report errors when task service is not defined

        return 'tick';
    }
}
