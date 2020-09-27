<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Utilities\Helper;
use Illuminate\Support\Facades\Input;
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

    public function create(Request $request){
        $result = $this->db->insert($request);
        return response()->json(['results' =>$result]);
    }


    public function delete(Request $request){
        $result = $this->db->delete($request);
        return response()->json(['results' =>$result]);
    }


    public function tick(){

        // this is not scalable. ideally we should be doing a single transaction for db update depending on the type of db we have setup
        $tasks = $this->db->selectAll();
        foreach ($tasks as $task) {
            $object = $this->helper->tick($task);
            $this->db->update($object);
        }
        return $this->db->selectAll();
    }

}
