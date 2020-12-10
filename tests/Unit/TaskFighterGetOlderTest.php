<?php

namespace Tests\Unit;

use App\Task;
use App\TaskFighter;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskFighterGetOlderTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function test_getOlder_priorityNeverNegative()
    {
        $task = factory(Task::class)->make([
            'name' => 'Get Older',
        ]);

        $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);

        for ($x = 0; $x < 200; $x++) {
            $taskFighter->tick();
        }

        $this->assertTrue($taskFighter->priority >= 0);
    }

    /**
     * @return void
     */
    public function test_getOlder_decreasesInPriorityOlderItGets()
    {
        $task = factory(Task::class)->make([
            'name' => 'Get Older',
        ]);

        $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);
        $taskFighter->tick();

        $this->assertTrue($taskFighter->priority < $task->priority);
    }

    /**
     * @return void
     */
    public function test_getOlder_dueInDecreasesEveryDay()
    {
        $task = factory(Task::class)->make([
            'name' => 'Get Older',
        ]);

        $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);
        $taskFighter->tick();

        $this->assertTrue($taskFighter->dueIn < $task->dueIn);
    }

    /**
     * @return void
     */
    public function test_getOlder_priorityNeverMoreThan100()
    {
        $task = factory(Task::class)->make([
            'name' => 'Get Older',
        ]);

        $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);

        for ($x = 0; $x < 200; $x++) {
            $taskFighter->tick();
        }

        $this->assertTrue($taskFighter->priority <= 100);
    }
}
