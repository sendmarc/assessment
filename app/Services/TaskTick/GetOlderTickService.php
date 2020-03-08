<?php
namespace App\Services\TaskTick;

use App\Abstracts\TaskServiceAbstract;
use App\TaskFighter;

/**
 * Class GetOlderTickService
 *
 * @package App\Services
 */
class GetOlderTickService extends TaskServiceAbstract {
    /**
     * @return TaskFighter
     */
    public function run(): TaskFighter
    {
        --$this->taskFighter->dueIn;
        if ($this->taskFighter->priority > 0) {
            --$this->taskFighter->priority;
            if ($this->taskFighter->dueIn < 0) {
                --$this->taskFighter->priority;
            }
        }

        return $this->taskFighter;

    }
}
