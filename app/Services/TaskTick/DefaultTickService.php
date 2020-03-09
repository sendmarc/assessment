<?php
namespace App\Services\TaskTick;

use App\Abstracts\TaskServiceAbstract;
use App\TaskFighter;

/**
 * Class BreatheTickService
 *
 * @package App\Services
 */
class DefaultTickService extends TaskServiceAbstract {
    /**
     * @return TaskFighter
     */
    public function run(): TaskFighter
    {
        --$this->taskFighter->dueIn;

        if($this->taskFighter->priority < 100){
            ++$this->taskFighter->priority;
        }

        return $this->taskFighter;

    }
}
