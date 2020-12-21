<?php

namespace App;

class TaskFighter
{
    /** @var string */
    public $name;

    /** @var int */
    public $priority;

    /** @var int */
    public $dueIn;

    /** @var int */
    private $priorityIncrement = 1;

    /** @var int */
    private $priorityFasterIncrement = 2;

    /** @var int */
    private $priorityMax = 100;

    /** @var int */
    private $priorityMin = 0;

    /** @var int */
    private $priorityWarnCheck = 10;

    /** @var int */
    private $priorityWarnIncrement = 2;

    /** @var int */
    private $priorityDangerCheck = 5;

    /** @var int */
    private $priorityDangerIncrement = 3;

    /**
     * TaskFighter constructor.
     * @param string $name
     * @param int $priority
     * @param int $due_in
     */
    public function __construct(string $name, int $priority, int $due_in)
    {
        $this->name = $name;
        $this->priority = $priority;
        $this->dueIn = $due_in;
    }

    /**
     * Tick method
     */
    public function tick()
    {
        switch ($this->name) {
            case 'Breathe':
                break;
            case 'Get Older':
                $this->getOlder();
                break;
            case 'Complete Assessment':
                $this->completeAssessment();
                break;
            default:
                $this->all();
        }
    }

    /**
     * For "Get Older" tasks
     */
    private function getOlder()
    {
        $this->dueIn--;

        if ($this->priority > $this->priorityMin) {
            $this->priority -= $this->priorityIncrement;
        }
    }

    /**
     * For "Complete Assessment" tasks
     */
    private function completeAssessment()
    {
        $this->dueIn--;

        if ($this->dueIn >= 0) {

            if ($this->dueIn <= $this->priorityWarnCheck && $this->dueIn > $this->priorityDangerCheck) {
                $this->priority += $this->priorityWarnIncrement;
            } elseif ($this->dueIn <= $this->priorityDangerCheck) {
                $this->priority += $this->priorityDangerIncrement;
            } else {
                $this->priority += $this->priorityIncrement;
            }
        } else {
            $this->priority = $this->priorityMin;
        }
    }

    /**
     * For all other tasks
     */
    private function all()
    {
        $this->dueIn--;

        if ($this->priority < $this->priorityMax) {
            $this->priority = $this->dueIn >= 0 ? $this->priority + $this->priorityIncrement : $this->priority + $this->priorityFasterIncrement;
        }
    }
}
