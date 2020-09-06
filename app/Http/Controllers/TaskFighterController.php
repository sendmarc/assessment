<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Utilities\Helper;
use App\Http\Controllers\TaskFighterRepository;

class TaskFighterController extends Controller
{

    public $helper;
    public $db;

    public function __construct(Helper $helper,TaskFighterRepository $taskFighterRepository)
    {
        $this->helper = $helper;
        $this->db = $taskFighterRepository;
    }

    public function home(){
        return view('TaskFighter.index');
    }


    public function fetchData(){
        $data = $this->db->selectAll();
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
        $tasks = $this->db->selectAll();
        foreach ($tasks as $task) {
            $object = $this->helper->tick($task);
            $this->db->update($object);
        }
        return $this->db->selectAll();
    }

}
