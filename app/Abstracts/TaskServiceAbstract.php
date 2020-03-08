<?php

namespace App\Abstracts;

use App\TaskFighter;

/**
 * Class TaskServiceAbstract
 *
 * @package App\Abstracts
 * @property TaskFighter $taskFighter
 */
abstract class TaskServiceAbstract
{
    public $taskFighter;

    /**
     * TaskServiceAbstract constructor.
     *
     * @param TaskFighter $taskFighter
     */
    public function __construct(TaskFighter $taskFighter)
    {
        $this->taskFighter = $taskFighter;
        $this->run();
    }

    /**
     * @return TaskFighter
     */
    public function response(): TaskFighter
    {
        return $this->taskFighter;
    }

    abstract public function run(): TaskFighter;

}
