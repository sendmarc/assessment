<?php
namespace App\Http\Utilities;

class Helper {

    public $object;
    public $priority;

    private function check(){
        if($this->object->dueIn <= 0 || $this->object->name !== 'Breathe' || $this->object->name !== 'Get Older'){
            //all priorities increase twice as fast? but breathe doesnt and get older doesnt increase
            $this->priority = 2;
        }


        if($this->object->name == 'Get Older'){
            $this->GetOlder();
        }elseif($this->object->name == 'Complete Assessment'){
            $this->CompleteAssessment();
        }
        $this->final_check();
        return $this->object;
    }

    private function GetOlder(){
        // make this a function just incase we need to add more rules later
        $this->object->priority = ($this->object->priority-1);
    }

    public function CompleteAssessment(){

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




    public function tick($object){
        $this->object = $object;
        if($this->object->name !== 'breath'){
            $this->object = $this->check();
        }
        return $this->object;
    }



}
