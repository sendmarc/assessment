<?php

namespace App;

class TaskFighter
{
    public $name;

    public $priority;

    public $dueIn;

    public function __construct($name, $priority, $due_in)
    {
        $this->name = $name;
        $this->priority = $priority;
        $this->dueIn = $due_in;
    }

    public static function of($name, $priority, $dueIn) {
        return new static($name, $priority, $dueIn);
    }

    public function tick()
    {
        switch ($this->name){
            case 'Get Older':
                if($this->priority < 100) {
                    $this->priority -=  1;
                    $this->dueIn -= 1;
                }

                break;
            case  'Breathe':
                //never has to be completed or increase in priority
                break;

            case  'Complete Assessment':
                if($this->dueIn > 0  && $this->dueIn < 11){
                    $this->priority += ($this->dueIn > 5) ? 2 : 3;
                    $this->dueIn = $this->dueIn - 1;
                }
                elseif($this->dueIn < 0){
                    $this->priority = 0;
                    $this->dueIn -= 1;
                }
                elseif($this->priority < 100) {
                    $this->priority +=  1;
                    $this->dueIn -= 1;
                }

                break;
            default:
                    if($this->dueIn < 0 && $this->priority < 100){
                       $this->priority += 2;
                    }
                    else{
                        if($this->priority < 100)
                            $this->priority += 1;
                    }
                    $this->dueIn -= 1;
                break;
        }

    }
}
