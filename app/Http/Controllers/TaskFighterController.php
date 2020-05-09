<?php

namespace App\Http\Controllers;

use App\TaskFighter;
use App\TaskFighterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TaskFighterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = TaskFighterModel::latest()->get();
        $title = "Tasks";
        $data = ['title' => $title, 'message' => $tasks];
        return response()->json($data);

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
        $task = new TaskFighterModel();
        $task->name     =  $request->name;
        $task->priority =  $request->priority;
        $task->dueIn    =  $request->dueIn;
        $task->save();
        return 'created';

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
        $tasks = TaskFighterModel::find($id);
        $tasks->delete();
        return redirect('/')->withSuccess('Task Deleted Successfully!!!');
    }

    public function tickItem(){
        $tasks = TaskFighterModel::get();
        foreach ($tasks as $task) {
            $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);
            $taskFighter->tick();
            $tasks              = TaskFighterModel::find($task->id);
            $tasks->priority    = $taskFighter->priority;
            $tasks->dueIn       = $taskFighter->dueIn;
            $tasks->save();
        }
        return redirect('/')->withSuccess('Task updated Successfully!!!');
    }
}
