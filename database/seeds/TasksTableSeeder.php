<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        $tasks = [
            ['name' => 'Get Older', 'priority' => 50, 'dueIn' => 365],
            ['name' => 'Breathe', 'priority' => 1000, 'dueIn' => 30],
            ['name' => 'Complete Assessment', 'priority' => 50, 'dueIn' => 15],
        ];

        foreach($tasks as $task){
            $new_task = new \App\Task();
            $new_task->name = $task['name'];
            $new_task->priority = $task['priority'];
            $new_task->dueIn = $task['dueIn'];
            $new_task->save();
        }
    }
}
