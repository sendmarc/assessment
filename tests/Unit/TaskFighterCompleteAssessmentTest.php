<?php

namespace Tests\Unit;

use App\Task;
use App\TaskFighter;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskFighterCompleteAssessmentTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function test_completeAssessment_priorityNeverNegative()
    {
        $task = factory(Task::class)->make([
            'name' => 'Complete Assessment',
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
    public function test_completeAssessment_priorityIncreasesEveryDay()
    {
        $task = factory(Task::class)->make([
            'name' => 'Complete Assessment',
        ]);

        $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);
        $taskFighter->tick();

        $this->assertTrue($taskFighter->priority > $task->priority);
    }

    /**
     * @return void
     */
    public function test_completeAssessment_dueInDecreasesEveryDay()
    {
        $task = factory(Task::class)->make([
            'name' => 'Complete Assessment',
        ]);

        $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);
        $taskFighter->tick();

        $this->assertTrue($taskFighter->dueIn < $task->dueIn);
    }

    /**
     * @return void
     */
    public function test_completeAssessment_priorityNeverMoreThan100()
    {
        $task = factory(Task::class)->make([
            'name' => 'Complete Assessment',
        ]);

        $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);

        for ($x = 0; $x < 200; $x++) {
            $taskFighter->tick();
        }

        $this->assertTrue($taskFighter->priority <= 100);
    }

    /**
     * @return void
     */
    public function test_completeAssessment_priorityIncreasesBy2When10DaysOrLess()
    {
        $task = factory(Task::class)->make([
            'name' => 'Complete Assessment',
            'priority' => 10,
            'dueIn' => 10,
        ]);

        $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);
        $taskFighter->tick();

        $this->assertTrue($taskFighter->priority === 12);
    }

    /**
     * @return void
     */
    public function test_completeAssessment_priorityIncreasesBy3When5DaysOrLess()
    {
        $task = factory(Task::class)->make([
            'name' => 'Complete Assessment',
            'priority' => 10,
            'dueIn' => 5,
        ]);

        $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);
        $taskFighter->tick();

        $this->assertTrue($taskFighter->priority === 13);
    }

    /**
     * @return void
     */
    public function test_completeAssessment_priorityDropsTo0AfterDueDate()
    {
        $task = factory(Task::class)->make([
            'name' => 'Complete Assessment',
            'dueIn' => -1,
        ]);

        $taskFighter = new TaskFighter($task->name, $task->priority, $task->dueIn);
        $taskFighter->tick();

        $this->assertTrue($taskFighter->priority === 0);
    }
}
