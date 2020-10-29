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

    public static function of($name, $priority, $dueIn)
    {
        return new static($name, $priority, $dueIn);
    }

    public function tick()
    {
        $incrementFactor = 1;

        switch ($this->name) {
            case 'Get Older':
                if ($this->priority > 0) $this->priority -= 1;
                break;

            case 'Complete Assessment':
                if ($this->dueIn <= 0) {
                    $this->priority = 0;
                    break;
                }

                if ($this->dueIn <= 5) $incrementFactor = 3;
                elseif ($this->dueIn > 5 && $this->dueIn <= 10) $incrementFactor = 2;
                else $incrementFactor = 1;

                $this->priority += $incrementFactor;
                break;

            case 'Breathe':
                break;

            default:
                if ($this->dueIn <= 0)
                    $this->priority = $this->priority * 2 > 100 ? 100 : $this->priority * 2;
                elseif ($this->priority >= 100) {
                    $this->priority = 100;
                    break;
                } else
                    $this->priority += $incrementFactor;
                break;
        }
        $this->dueIn -= 1;
    }
}
