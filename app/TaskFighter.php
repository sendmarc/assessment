<?php

namespace App;

use App\Ticker\DefaultStrategy;
use App\Ticker\NegativeStrategy;
use App\Ticker\PositiveStrategy;
use App\Ticker\Ticker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TaskFighter extends Model
{
    public $name;

    public $priority;

    public $dueIn;

    protected $table = 'tasks';

    public static function of($name, $priority, $dueIn)
    {
        $task = new static;
        $task->name = $name;
        $task->priority = $priority;
        $task->dueIn = $dueIn;

        return $task;
    }

    public function tick()
    {
        $ticker = new Ticker;

        $task = Str::snake($this->name);

        if($task !== 'spin_the_world') {

            if($task === 'complete_assessment') {
                $ticker->setStrategy(new PositiveStrategy);
            }
            else if($task === 'get_older') {
                $ticker->setStrategy(new NegativeStrategy);
            }
            else {
                $ticker->setStrategy(new DefaultStrategy);
            }
        }

        $ticker->tick($this);
    }
}
