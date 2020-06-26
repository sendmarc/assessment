<?php

namespace App;

class TaskFighter
{
    public $name;

    public $priority;

    public $dueIn;

    CONST GET_OLDER = 'Get Older';
    CONST COMPLETE_ASSESSMENT = 'Complete Assessment';
    CONST BREATHE = 'Breathe';

    public function __construct($name = null, $priority = null, $due_in = null)
    {
        $this->name = $name;
        $this->priority = $priority;
        $this->dueIn = $due_in;
    }

    public static function of($name, $priority, $dueIn)
    {
        return new static($name, $priority, $dueIn);
    }

    public function tick()
    {
        $tasksToSkip = [self::BREATHE];
        $taskLookup[self::GET_OLDER]['priority_interval'] = -1;
        $taskLookup[self::COMPLETE_ASSESSMENT]['priority_interval'] = 1;

        if (in_array($this->name, $tasksToSkip)) { // Do not try to process a task-to-skip any further
            return true;
        }

        $this->dueIn = $this->dueIn - 1;
        if ($this->priority > 100 || $this->priority <= 0) { // Do not process a task with priority greater than 100 or <= 0
            return true;
        }

        $this->updatePriority(!empty($taskLookup[$this->name]) ? $taskLookup[$this->name]['priority_interval'] : 1);
    }

    /**
     * Set a new priority for a task
     *
     * @param null $priorityInterval
     * @return bool
     */
    private function updatePriority($priorityInterval = null)
    {
        if ($this->name === self::COMPLETE_ASSESSMENT) {
            $sixDays = 6;
            $elevenDays = 11;
            if ($this->dueDatePassed()) {
                $this->priority = 0;
            } elseif ($this->dueIn < $elevenDays && $this->dueIn > $sixDays) {
                $this->priority += 2;
            } elseif ($this->dueIn < $sixDays) {
                $this->priority += 3;
            } else {
                $this->priority += $priorityInterval;
            }
            $this->regulatePriority();
            return true;
        }

        if ($this->dueDatePassed()) {
            $this->priority += ($priorityInterval * 2);
        } else {
            $this->priority += $priorityInterval;
        }
        $this->regulatePriority();
    }

    /**
     * Check if task has passed the due date
     * @return bool
     */
    private function dueDatePassed()
    {
        if ($this->dueIn <= 0) {
            return true;
        }
        return false;
    }

    /**
     * Ensure that priority never goes above 100 or below 0
     */
    private function regulatePriority(): void
    {
        if ($this->priority > 100) {
            $this->priority = 100;
        }

        if ($this->priority < 0) {
            $this->priority = 0;
        }
    }
}
