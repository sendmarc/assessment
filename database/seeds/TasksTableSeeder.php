<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tasks')->insert([
            ['name' => 'Test Task 01','type' => 'Get Older', 'priority' => 50, 'dueIn' => 365],
            ['name' => 'Task Two','type' => 'Breathe', 'priority' => 1000, 'dueIn' => 30],
            ['name' => 'Final Task','type' => 'Complete Assessment', 'priority' => 50, 'dueIn' => 15],
        ]);
    }
}
