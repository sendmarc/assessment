<?php
namespace App\Ticker;

use App\TaskFighter;

class PositiveStrategy implements TickerStrategy
{
    public function apply(TaskFighter $task)
    {
        $increaseBy = 1;

        if($task->dueIn <= 5) {
            $increaseBy = 3;
        }
        else if($task->dueIn <= 10) {
           $increaseBy = 2;
        }

        $task->priority = $task->priority + $increaseBy;
      
    }
}