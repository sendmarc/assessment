<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Task;
use App\TaskFighter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskFighterController extends Controller
{
    private $rules = [
        'name' => 'required',
        'priority' => 'required|integer|between:0,100',
        'dueIn' => 'required|integer'
    ];

    public function index()
    {
        return Task::all();
    }

    /**
     * Save a new task. Prevents saving the same task more than once.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store()
    {
        try {
            $data = request()->validate($this->rules);
            return Task::firstOrCreate($data);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update($id)
    {
        try {
            $data = request()->validate($this->rules);

            if (Task::where('id', $id)->update($data)) {
                return $data;
            }
            return response('Could not edit task', 500);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }

    /**
     *  Delete a task
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (Task::where('id', $id)->delete()) {
                Log::info(sprintf('Deleting task id %s', $id));
                return response('Task deleted');
            }
            return response('No task to delete', 500);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }

    /**
     *  Update task priority and dueIn
     *
     * @return Task[]|\Illuminate\Database\Eloquent\Collection
     */
    public function tick()
    {
        $tasks = DB::table('tasks')->select('*')->get();
        foreach ($tasks as $task) {
            $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);
            $taskFighter->tick();
            Task::where('id', $task->id)->update(['priority' => $taskFighter->priority, 'dueIn' => $taskFighter->dueIn]);
        }
        return Task::all();
    }
}
