<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'priority' => 100,
        'dueIn' => 0,
    ];

    /**
     * Lower the priority of the task
     */
    protected function lower_priority()
    {
        if ($this->priority > env('MIN_PRIORITY', 0)) {
            $this->priority = $this->priority - 1;
        }
    }


    /**
     * Heighten the priority of the default task
     * 
     */
    protected function increase_default_priority($rate)
    {
        $max_prio = env('MAX_PRIORITY', 100);

        //Is the priority less then limit
        if ($this->priority < $max_prio) {

            //Check for double priority increase
            if ($this->dueIn < 0) {
                $this->priority = $this->priority + ($rate * 2);
            } else {
                $this->priority = $this->priority + ($rate);
            }

            // This check is only necessary when iterating by 2 or more to insure priority never above limit
            if ($this->priority > $max_prio) {
                $this->priority = $max_prio;
            }
        }
    }

    /**
     * Heighten the priority of the default task
     * 
     */
    protected function increase_special_priority()
    {
        if ($this->dueIn < 0) {
            if ($this->priority != 0) {
                $this->priority = 0;
            }
        } elseif ($this->dueIn <= 5) {
            $this->increase_default_priority(3);
        } elseif ($this->dueIn <= 10) {
            $this->increase_default_priority(2);
        } else {
            $this->increase_default_priority(1);
        }
    }

    public function tick()
    {
        // Modify independant variable  first
        $this->dueIn = $this->dueIn - 1;

        switch ($this->name) {
            case 'Breathe':
                break;
            case 'Get Older':
                $this->lower_priority();
                break;
            case 'Complete Assessment':
                $this->increase_special_priority();
                break;
            default:
                $this->increase_default_priority(1);
        }
    }
}
