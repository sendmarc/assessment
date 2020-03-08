<?php

namespace App\Services\TaskTick;

use App\Abstracts\TaskServiceAbstract;
use App\TaskFighter;

/**
 * Class CompleteAssessmentTickService
 *
 * @package App\Services
 */
class CompleteAssessmentTickService extends TaskServiceAbstract
{
    /**
     * @return TaskFighter
     */
    public function run(): TaskFighter
    {
        --$this->taskFighter->dueIn;
        if ($this->taskFighter->priority < 100) {
            ++$this->taskFighter->priority;
            if ($this->taskFighter->dueIn < 11) {
                $this->taskFighter->priority += 2;
            }
        }

       return $this->taskFighter;
    }
}
