<?php
namespace App\Http\Utilities;

class Helper {

    public $object;
    public $priority;

    /*
    This helper class is needlesly complicated
    this is simply cause i havent had time to learn more about
    how the elixer orm works to put the rules into a database and write a function to call and process
    those rules against the messaging que so for now i am leaving this as is. i will make a helper class db
    to contain that logic if i have the time next
    */

    private function check(){
        if($this->object->dueIn <= 0 || $this->object->name !== 'Breathe' || $this->object->name !== 'Get Older'){
            //all priorities increase twice as fast? but breathe doesnt and get older doesnt increase
            $this->priority = 2;
        }

        //determine method based on name
        if($this->object->name == 'Get Older'){
            $this->GetOlder();
        }elseif($this->object->name == 'Complete Assessment'){
            $this->CompleteAssessment();
        }

        //final update
        $this->final_check();
        return $this->object;
    }

    private function GetOlder(){
        // make this a function just incase we need to add more rules later
        $this->object->priority = ($this->object->priority-1);
    }

    public function CompleteAssessment(){
        // condional logic based on period
        if($this->object->dueIn <= 10 && $this->object->dueIn > 5){
            $this->priority = 2;
        }elseif($this->object->dueIn <= 5){
            $this->priority = 3;
        }else{
            $this->priority = 1;
        }
        $this->object->priority = ($this->object->priority + $this->priority);
    }

    private function final_check(){

        // lets resolve priority and insure its never greater than 100 or less than 0
        if(intval($this->object->priority) <= 0){
            $this->object->priority = 0;
        }elseif(intval($this->object->priority) > 100){
            $this->object->priority = 100;
        }

        // finally lets update the dueIn date and insure its never less than 0
        if($this->object->name !== 'Breathe'){
            $this->object->dueIn--;
        }else{
            $this->object->priority = 1000;
        }
    }

    //this is in a helper class so other classes can also take advantage of it
    public function tick($object){
        $this->object = $object;
        if($this->object->name !== 'breath'){
            $this->object = $this->check();
        }
        return $this->object;
    }



}
