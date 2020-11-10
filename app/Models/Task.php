<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    public function tick() {
    	switch ($this->name) {
            case 'Get Older':
                $this->dueIn -= 1;
                $this->priority -= $this->priority > 0 ? 1 : 0;

                break;
            case 'Complete Assessment':
                $this->dueIn -= 1;
                $this->priority += $this->dueIn < 6 ? 3 : $this->dueIn < 11 ? 2 : 1;

                if ($this->dueIn < 0) {
                    $this->priority = 0;
                } elseif ($this->priority > 100) {
                    $this->priority = 100;
                }

                break;
            default:
                break;
        }

        $this->save();
    }
}
