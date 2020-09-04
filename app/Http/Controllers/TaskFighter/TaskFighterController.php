<?php
namespace app\Http\Controllers;


class TaskFighterController {

    public function home(){
        return view('TaskFighter.index');
    }

    public function create(){
        //TODO
    }

    public function delete(){
       //TODO
    }

    public function tick(){
        //TODO
        foreach ($tasks as $task) {
            $taskFighter = new \App\TaskFighter($task->name, $task->priority, $task->dueIn);
            $taskFighter->tick();

        }
        return 'tick';
    }
}
