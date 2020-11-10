<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task as TaskModel;

class Task extends Controller
{
    public function getAllTasks() {
    	return TaskModel::all();
    }

    public function createTask(Request $request, int $id) {
    	$task = new TaskModel;
    	$task->name = $request->name;
    	$task->priority = $request->priority;
    	$task->dueIn = $request->dueIn;
    	$task->save();

    	return response()->json([
    		"message" => "Task Created",
    	], 202);
    }

    public function deleteTask(int $id) {
    	$task = TaskModel::where('id', $id);

    	if ($task->exists()) {
    		$task->first()->delete();

    		return response()->json([
    			"message" => "Task Deleted",
    		], 202);
    	} else {
    		return response()->json([
    			"message" => "Task Not Found",
    		], 404);
    	}
    }

    public function tick(int $id) {
    	$tasks = TaskModel::all();

    	foreach ($tasks as $task) {
	        $task->tick();
    	}

    	return response()->json([
    			"message" => "Tasks Ticked",
    		], 200);
    }
}
