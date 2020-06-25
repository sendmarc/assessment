<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Task;

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
}
