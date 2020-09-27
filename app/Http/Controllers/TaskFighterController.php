<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Utilities\Helper;
use App\Http\Controllers\TaskFighterRepository;

/*
    All core views are placed together
    ones that need additional behaviour
    gets that through another function
*/
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
        return response()->json($data);
    }

    public function create(Request $request){
        $result = $this->db->insert($request);
        return response()->json(['results' => $result]);
    }


    public function delete(Request $request){
        $result = $this->db->delete($request);
        return response()->json(['results' =>$result]);
    }


    public function tick(){
        /*
            Not a very scalable solution.
            Ideally we will store the configuration into a database
            this should then allow us to define task types
            and rulesets. this should also be handled by a messaging que
            to help us better handle the processing of tasks for performance
        */
        $tasks = $this->db->selectAll();
        foreach ($tasks as $task) {
            $object = $this->helper->tick($task);
            $this->db->update($object);
        }
        return $this->db->selectAll();
    }

}
