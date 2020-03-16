<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['name', 'priority', 'dueIn'];

//    public $name;
//    public $priority;
//    public $dueIn;

    private static function changePriority($priority, $dueIn, $modifier = 1)
    {
        $priority += $modifier * ($dueIn <= 0 ? 2 : 1);
        if ($priority > 100) return 100;
        else if ($priority < 0) return 0;
        else return $priority;
    }

    private static function changeDueIn($dueIn, $modifier = -1)
    {
        $dueIn += $modifier;
        return $dueIn;
    }

    private function tickDefault()
    {
        $this->priority = self::changePriority($this->priority, $this->dueIn);
        $this->dueIn = self::changeDueIn($this->dueIn);
    }

    private function tickGetOlder()
    {
        $this->priority = self::changePriority($this->priority, $this->dueIn, -1);
        $this->dueIn = self::changeDueIn($this->dueIn);
    }

    private function tickCompleteAssessment()
    {
        if ($this->dueIn > 10) {
            $this->priority = self::changePriority($this->priority, 1, 1);
        } else if ($this->dueIn > 5) {
            $this->priority = self::changePriority($this->priority, 1, 2);
        } else if ($this->dueIn > 0 ) {
            $this->priority = self::changePriority($this->priority, 1, 3);
        } else {
            $this->priority = 0;
        }
        $this->dueIn = self::changeDueIn($this->dueIn);
    }

    private function tickBreathe()
    {
        //Change nothing on breathe
        return;
    }


    public function tick()
    {
        switch ($this->name) {
            case "Get Older":
                return $this->tickGetOlder();
            case "Complete Assessment":
                return $this->tickCompleteAssessment();
            case "Breathe":
                return $this->tickBreathe();
            default:
                return $this->tickDefault();
        }
    }
}
