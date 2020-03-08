<?php
namespace App\Services\TaskTick;

use App\Abstracts\TaskServiceAbstract;
use App\TaskFighter;

/**
 * Class BreatheTickService
 *
 * @package App\Services
 */
class BreatheTickService extends TaskServiceAbstract {
    /**
     * @return TaskFighter
     */
    public function run(): TaskFighter
    {
        if($this->taskFighter->dueIn < 0){
            $this->taskFighter->priority -= $this->taskFighter->priority;
        }

        return $this->taskFighter;
    }
}
