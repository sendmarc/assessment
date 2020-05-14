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
                if ($this->priority > 0) {
                    $this->priority = $this->priority - 1;
                }
                if($this->dueIn < 0){
                    $this->priority = $this->priority + 2;
                }
                else{
                    $this->dueIn = $this->dueIn - 1;
                }

                break;
            case  'Breathe':
                //never has to be completed or increase in priority
                break;

            case  'Complete Assessment':
                $this->dueIn = $this->dueIn - 1;
                if($this->dueIn >0  && $this->dueIn < 11){
                    $this->priority = ($this->dueIn >= 5) ? $this->priority + 2:$this->priority + 3;
                }
                elseif($this->dueIn < 0){
                    $this->priority = 0;
                }
                else{
                    if ($this->priority < 100) {
                        $this->priority = $this->priority + 1;
                    }
                    else{
                        $this->dueIn = $this->dueIn - 1;
                    }
                }
                break;
            default:
                    if($this->dueIn <= 0){
                        if($this->priority < 100)
                        {
                            $this->priority = $this->priority + 2;
                        }
                        else{
                            $this->dueIn = $this->dueIn - 1;
                        }
                    }
                    else{
                        $this->dueIn = $this->dueIn - 1;
                        $this->priority = $this->priority + 1;
                    }
                break;
        }

    }
}
