<?php
namespace App\Ticker;

use App\TaskFighter;

class DefaultStrategy implements TickerStrategy
{
    public function apply(TaskFighter $task)
    {
        $priority = $task->priority + 1;

        if(!$task->due) {
            $priority = $task->priority * 2;
        }

        $task->priority = $priority;
    }
}