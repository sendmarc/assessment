<?php

use Illuminate\Database\Seeder;

class TaskFactorySeeder extends Seeder
{
    public function run()
    {
        factory(App\Task::class, 5)->create();
    }
}
