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
        $tasks = TaskFighterModel::get();
        $title = "Tasks";
        return View::make('tasks.tasks', compact('tasks','title'))->render();
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
//        Route::post('/tasks', function(\Illuminate\Http\Request $request) {
//            DB::insert("insert into tasks set name = '{$request->name}', priority = '{$request->priority}', dueIn = '{$request->dueIn}'");
//            return 'created';
//        });
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
//        Route::delete('/tasks/{id}', function(\Illuminate\Http\Request $request) {
//            DB::delete("delete from tasks where id = '{$request->id}'");
//            return 'deleted';
//        });
    }
}
