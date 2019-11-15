<?php
namespace App\Ticker;

use App\TaskFighter;

class NegativeStrategy implements TickerStrategy
{
    public function apply(TaskFighter $task)
    {
        $task->priority = $task->priority - 1;
    }
}