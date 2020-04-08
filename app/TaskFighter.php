<?php

namespace App;

class TaskFighter
{

    public function tick($name, $priority, $dueIn)
    {
        if ($name != 'Get Older') {
            if ($priority < 100) {
                if ($name != 'Breathe') {
                    $priority += 1;
                }
            }
            if ($name == 'Complete Assessment') {
                if ($dueIn < 11) {
                    if ($priority < 100) {
                        $priority += 1;
                    }
                }
                if ($dueIn < 6) {
                    if ($priority < 100) {
                        $priority += 1;
                    }
                }
            }
        } else {
            if ($priority > 0) {
                $priority -= 1;
            }
        }
        if ($name != 'Breathe') {
            $dueIn -= 1;
        }
        if ($dueIn < 0) {
            if ($name != 'Get Older') {
                if ($name != 'Complete Assessment') {
                    if ($priority < 100) {
                        if ($name != 'Breathe') {
                            $priority += 1;
                        }
                    }
                } else {
                    $priority -= $priority;
                }
            } else {
                if ($priority > 0) {
                    $priority -= 1;
                }
            }
        }
        
        return array("priority"=>$priority,"dueIn"=>$dueIn);
    }
}
