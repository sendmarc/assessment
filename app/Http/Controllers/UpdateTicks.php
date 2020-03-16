<?php

namespace App\Http\Controllers;

use App\TaskFighter;
use Illuminate\Http\Request;

class UpdateTicks extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        foreach(TaskFighter::all() as $task) {
            $task->tick();
            $task->save();
        }
        return response()->json(null, 204);
    }
}
