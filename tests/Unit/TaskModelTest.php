<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Task;

class TaskModelTest extends TestCase
{

    /**
     * Task creation test.
     *
     * @return void
     */
    public function testCreateAndStoreTask()
    {
        $task = factory(Task::class)->create();
        $this->assertInstanceOf(Task::class, $task);
        $this->assertArrayHasKey('name', $task);
        $this->assertArrayHasKey('dueIn', $task);
        $this->assertArrayHasKey('priority', $task);

        $task->save();
        $this->assertTrue($task->isClean());

        $id = $task->id;
        $name = $task->name;

        $this->assertEquals(Task::find($id)->fresh()->name, $name);
    }

    public function testBreathe()
    {
        $breathe = Task::query()->where('name', 'Breathe')->first();
        $this->assertInstanceOf(Task::class, $breathe);
        $this->assertEquals(1000, $breathe->priority);
        $breathe->tick();
        // Expected priority should not change
        $this->assertEquals(1000, $breathe->priority);
    }

    public function testGetOlder()
    {
        $get_older = Task::query()->where('name', 'Get Older')->first();
        $this->assertInstanceOf(Task::class, $get_older);
        $old_priority = $get_older->priority;
        $get_older->tick();
        // Expected priority should decrease
        $this->assertTrue($old_priority > $get_older->priority);
    }

    public function testCompleteAssessment()
    {
        $comp_assessment = Task::query()->where('name', 'Complete Assessment')->first();
        $this->assertInstanceOf(Task::class, $comp_assessment);
        $comp_assessment->priority = 50;

        $comp_assessment->dueIn = 50;
        $comp_assessment->tick();
        // Expected priority should increase by 1
        $this->assertEquals(51, $comp_assessment->priority);

        $comp_assessment->dueIn = 10;
        $comp_assessment->tick();
        // Expected priority should increase by 2
        $this->assertEquals(53, $comp_assessment->priority);

        $comp_assessment->dueIn = 5;
        $comp_assessment->tick();
        // Expected priority should increase by 3
        $this->assertEquals(56, $comp_assessment->priority);

        $comp_assessment->dueIn = 0;
        $comp_assessment->tick();
        // Expected priority should be 0
        $this->assertEquals(0, $comp_assessment->priority);
        $comp_assessment->tick();
        // Expected priority should be 0
        $this->assertEquals(0, $comp_assessment->priority);
    }

    public function testPriorityMinimum()
    {
        $get_older = Task::query()->where('name', 'Get Older')->first();
        $this->assertInstanceOf(Task::class, $get_older);
        $get_older->priority = env('MIN_PRIORITY', 0);
        $get_older->tick();
        // Expected priority should stay at 0
        $this->assertEquals(0, $get_older->priority);
        $get_older->tick();
        // Expected priority should stay at 0
        $this->assertEquals(0, $get_older->priority);
    }

    public function testPriorityMaximum()
    {
        $get_older = Task::query()->where('name', 'Get Older')->first();
        $this->assertInstanceOf(Task::class, $get_older);
        $get_older->priority = env('MIN_PRIORITY', 0);
        $get_older->tick();
        // Expected priority should stay at 0
        $this->assertEquals(0, $get_older->priority);
        $get_older->tick();
        // Expected priority should stay at 0
        $this->assertEquals(0, $get_older->priority);
    }

    public function testPriorityDoubleRate()
    {
        $task = factory(Task::class)->create();
        $this->assertInstanceOf(Task::class, $task);

        $task->priority = 50;
        // 0 is not considered "passed" due date
        $task->dueIn = -1;
        $task->tick();
        // Expected priority should increase at double the rate (+2)
        $this->assertEquals(52, $task->priority);
        $task->tick();
        // Expected priority should stay at 0
        $this->assertEquals(54, $task->priority);
    }
}
