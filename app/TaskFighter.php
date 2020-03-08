<?php

namespace App;

use App\Abstracts\TaskServiceAbstract;
use App\Exceptions\TaskServiceAliasException;
use App\Services\TaskTickService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Class TaskFighter
 *
 * @package App
 * @property string $name
 * @property int $priority
 * @property int $dueIn
 */

class TaskFighter
{
    public $name;
    public  $priority;
    public  $dueIn;

    public function __construct($name, $priority, $dueIn)
    {
        $this->name = $name;
        $this->priority = $priority;
        $this->dueIn = $dueIn;
    }

    /**
     * @param $name
     * @param $priority
     * @param $dueIn
     *
     * @return TaskFighter
     */
    public static function of($name, $priority, $dueIn): TaskFighter
    {
        return new static($name, $priority, $dueIn);
    }

    public function tick(): void
    {
        $taskName = Str::studly($this->name);
        /** @var TaskFighter $tickFighter */
        $tickFighter = TaskTickService::getService($taskName, $this);
        $this->priority  = $tickFighter->priority;
        $this->dueIn  = $tickFighter->dueIn;
    }
}
