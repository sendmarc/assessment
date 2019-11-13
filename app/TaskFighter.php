<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskFighter extends Model
{
    public $name;

    public $priority;

    public $dueIn;

    protected $table = 'tasks';


    public static function of($name, $priority, $dueIn) {
        $task = new static;
        $task->name = $name;
        $task->priority = $priority;
        $task->dueIn = $dueIn;

        return $task;
    }

    public function tick()
    {
        if ($this->name != 'Get Older') {
            if ($this->priority < 100) {
                if ($this->name != 'Spin the World') {
                    $this->priority = $this->priority + 1;
                }
            }
            if ($this->name == 'Complete Assessment') {
                if ($this->dueIn < 11) {
                    if ($this->priority < 100) {
                        $this->priority = $this->priority + 1;
                    }
                }
                if ($this->dueIn < 6) {
                    if ($this->priority < 100) {
                        $this->priority = $this->priority + 1;
                    }
                }
            }
        } else {
            if ($this->priority > 0) {
                $this->priority = $this->priority - 1;
            }
        }
        if ($this->name != 'Spin the World') {
            $this->dueIn = $this->dueIn - 1;
        }
        if ($this->dueIn < 0) {
            if ($this->name != 'Get Older') {
                if ($this->name != 'Complete Assessment') {
                    if ($this->priority < 100) {
                        if ($this->name != 'Spin the World') {
                            $this->priority = $this->priority + 1;
                        }
                    }
                } else {
                    $this->priority = $this->priority - $this->priority;
                }
            } else {
                if ($this->priority > 0) {
                    $this->priority = $this->priority - 1;
                }
            }
        }
    }
}
