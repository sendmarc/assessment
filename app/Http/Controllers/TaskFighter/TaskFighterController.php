<?php

namespace App\Http\Controllers\TaskFighter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TaskFighterRepository;

class TaskFighterController extends Controller
{



    public function home(){
        return view('TaskFighter.index');
    }

    public function fetchData(TaskFighterRepository $taskFighterRepository){
        $data = $taskFighterRepository->selectAll();
        return $data;

    }

    public function create(){
        //TODO
        return view('TaskFighter.index');
    }


    public function delete(){
       //TODO
       return view('TaskFighter.index');
    }


    public function tick(){
        //TODO
      /*  foreach ($tasks as $task) {
            $taskFighter = new \App\TaskFighter($task->name, $task->priority, $task->dueIn);
            $taskFighter->tick();

        }*/
        return 'tick';
    }
}
