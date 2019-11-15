<?php
namespace App\Ticker;

use App\TaskFighter;

interface TickerStrategy 
{
    function apply(TaskFighter $task);
}