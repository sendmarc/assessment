<?php

namespace App\Http\Controllers;
use App\Http\Resources\TaskCollection;
use Illuminate\Http\Request;
use App\TaskFighter;
use App\Task;

class TaskController extends Controller
{
    public function store(Request $request)
    {
      $task = new Task([
        'name' => $request->get('name'),
        'priority' => $request->get('priority'),
        'dueIn' => $request->get('dueIn')
      ]);

       $task->save();

      return response()->json('successfully added');
    }

    public function index()
    {
      return new TaskCollection(Task::all());
    }

    public function tick($id, TaskFighter $taskFighter)
    {
      
            $task = Task::find($id);
              $taskFighter->tick();
              DB::update("update tasks set priority = '{$taskFighter->priority}', dueIn = '{$taskFighter->dueIn}' where id = '{$task->id}'");
          return 'tick';
    }

    public function edit($id)
    {
      $task = Task::find($id);
      return response()->json($task);
    }

    public function update($id, Request $request)
    {
       $task = Task::find($id);

       $task->update($request->all());

      return response()->json('successfully updated');
    }


    public function delete($id)
    {
       $task = Task::find($id);

       $task->delete();

      return response()->json('successfully deleted');
    }
}
