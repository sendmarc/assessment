<?php

namespace Tests\Unit;

use App\Task;
use App\TaskFighter;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskFighterBreatheTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function test_breathe_priorityNeverAlters()
    {
        $task = factory(Task::class)->make([
            'name' => 'Breathe',
        ]);

        $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);
        $taskFighter->tick();

        $this->assertTrue($taskFighter->priority === $task->priority);
    }

    /**
     * @return void
     */
    public function test_breathe_dueInNeverAlters()
    {
        $task = factory(Task::class)->make([
            'name' => 'Breathe',
        ]);

        $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);
        $taskFighter->tick();

        $this->assertTrue($taskFighter->dueIn === $task->dueIn);
    }

    /**
     * @return void
     */
    public function test_breathe_priorityNeverNegative()
    {
        $task = factory(Task::class)->make([
            'name' => 'Breathe',
        ]);

        $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);

        for ($x = 0; $x < 200; $x++) {
            $taskFighter->tick();
        }

        $this->assertTrue($taskFighter->priority >= 0);
    }
}
