<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        switch (strtolower($request->query('sort'))) {
            case 'name':
                $key = 'name';
                break;
            case 'priority':
                $key = 'priority';
                break;
            case 'duein':
            default:
                $key = 'dueIn';
                break;
        }
        return $request->has('desc') ? Task::all()->sortByDesc($key) : Task::all()->sortBy($key);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexview(Request $request)
    {
        return view('task')->with('tasks', $this->index($request));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $task = Task::create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task;

        $task->name = $request->name;
        $task->dueIn = $request->dueIn;
        $task->priority = $request->priority;

        $task->save();

        return $task->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Task::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function tick()
    {
        return Task::all()->reduce(function ($acc, $task) {
            $task->tick();
            $task->save();
            // Return true if even one record was modified
            $acc = ($acc == true) ? true : $task->wasChanged();
        }, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Task::destroy($id);
    }
}
