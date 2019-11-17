<?php
namespace App\Ticker;

use App\TaskFighter;

class Ticker 
{
    protected $strategy;

    public function __construct(?TickerStrategy $strategy = null)
    {
        $this->strategy = $strategy;
    }

    public function setStrategy(TickerStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function tick(TaskFighter $task)
    {
        $task->dueIn = $task->dueIn - 1;
        
        if($this->strategy) {
            $this->strategy->apply($task);
            $this->validatePriority($task);
        }
    }

    private function validatePriority(TaskFighter $task)
    {
        $priority = $task->priority;
        $priority = $priority < 0 ? 0 : $priority;
        $priority = $priority > 100 ? 100 : $priority;
        $task->priority = $priority;
    }
}