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
    private $priorityMax = 100;

    /** @var int */
    private $priorityMin = 0;

    /** @var int */
    private $priorityWarn = 10;

    /** @var int */
    private $priorityDanger = 5;

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

    public function tick()
    {
        if ($this->name !== 'Get Older') {
            if ($this->priority < $this->priorityMax) {
                if ($this->name !== 'Breathe') {
                    $this->priority = $this->priority + $this->priorityIncrement;
                }
            }
            if ($this->name === 'Complete Assessment') {
                if ($this->dueIn <= $this->priorityWarn) {
                    if ($this->priority < $this->priorityMax) {
                        $this->priority = $this->priority + $this->priorityIncrement;
                    }
                }
                if ($this->dueIn <= $this->priorityDanger) {
                    if ($this->priority < $this->priorityMax) {
                        $this->priority = $this->priority + $this->priorityIncrement;
                    }
                }
            }
        } else {
            if ($this->priority > $this->priorityMin) {
                $this->priority = $this->priority - $this->priorityIncrement;
            }
        }
        if ($this->name !== 'Breathe') {
            $this->dueIn = $this->dueIn - $this->priorityIncrement;
        }
        if ($this->dueIn < $this->priorityMin) {
            if ($this->name !== 'Get Older') {
                if ($this->name !== 'Complete Assessment') {
                    if ($this->priority < $this->priorityMax) {
                        if ($this->name != 'Breathe') {
                            $this->priority = $this->priority + $this->priorityIncrement;
                        }
                    }
                } else {
                    $this->priority = $this->priority - $this->priority;
                }
            } else {
                if ($this->priority > $this->priorityMin) {
                    $this->priority = $this->priority - $this->priorityIncrement;
                }
            }
        }
    }
}
