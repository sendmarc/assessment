<?php

namespace App\Http\Controllers;

use App\TaskFighter;
use App\TaskFighterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskFighterController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tasks = TaskFighterModel::latest()->get();
        $title = "Tasks";
        $data = ['title' => $title, 'handle_data' => $tasks];
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data =  $request->all();
        $rules = [
            'name'     => 'required|unique:tasks|max:200',
            'priority' => 'required|numeric|min:0|not_in:0|max:1000',
            'dueIn'    => 'required|numeric|min:0|not_in:0'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $messages   = $validator->errors()->first();
            return response()->json(['message' => $messages,'error'=> true],500);
        }
        else{
            $task = new TaskFighterModel();
            $task->name         = $data['name'];
            $task->priority     = $data['priority'];
            $task->dueIn        = $data['dueIn'];
            $task->save();
            return response()->json(['message' => 'Task Created Successfully!!!']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $tasks = TaskFighterModel::find($id);
        $tasks->delete();
        return response()->json(['message'=>'Task Deleted Successfully!!!']);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

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
        return response()->json(['message'=>'Tick Successfully executed!!!']);
    }
}
