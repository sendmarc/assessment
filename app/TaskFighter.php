<?php

namespace App;

use App\Task;

class TaskFighter
{
    public $name;

    public $priority;

    public $dueIn;

    public function __construct(Task $task)
    {
        $this->name = $task->name;
        $this->priority = $task->priority;
        $this->dueIn = $task->dueIn;
    }

    public static function of($name, $priority, $dueIn) {
        return new static($name, $priority, $dueIn);
    }

    public function tick()
    {
        if ($this->name != 'Breathe')
		{
			if ($this->priority < 100) 
			{
				if ($this->name == 'Get Older')
				{
						$this->priority -= 1;
				}
				else if ($this->name == 'Complete Assessment') 
				{
					if ($this->dueIn <= 1) 
					{
						$this->priority = 0;
					}
					else if ($this->dueIn <= 5)
					{
						$this->priority += 3;
					}
					else if ($this->dueIn <= 10)
					{
						$this->priority += 2;
					}
					else 
					{
						$this->priority += 1;
					}					
                }
                else
                {
                    $this->priority += 1;
                    if ($this->dueIn <= 0)
					{
						$this->priority += 1;
                    }
                }
            }
            $this->dueIn -= 1;
		}
    }
}
