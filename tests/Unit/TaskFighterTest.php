<?php

namespace Tests\Unit;

use App\TaskFighter;
use Tests\TestCase;

class TaskFighterTest extends TestCase
{

    public function testGetOlderCanDecreasePriority()
    {
        $task = TaskFighter::of('Get Older', 1, 1);

        $task->tick();

        $this->assertEquals(0, $task->priority);

    }

    public function testCompleteAssessmentDueInTenDaysOrLess() 
    {
        $task = TaskFighter::of('Complete Assessment', 50, 10);

        $task->tick();

        $this->assertEquals(52, $task->priority);
    }

    public function testCompleteAssessmentDueInFiveDaysOrLess() 
    {
        $task = TaskFighter::of('Complete Assessment', 50, 4);

        $task->tick();

        $this->assertEquals(53, $task->priority);
    }

    public function testTaskCannotExceedMaximumPriority()
    {
        $task = TaskFighter::of('Complete Assessment', 99, 4);

        $task->tick();

        $this->assertEquals(100, $task->priority);
    }

    public function testTaskCannotExceedMinimumPriority()
    {
        $task = TaskFighter::of('Get Older', 1, -2);

        $task->tick();
        $task->tick();

        $this->assertEquals(0, $task->priority);
    }

    public function testProrityIncreasesTwiceAfterDueDate()
    {
        $task = TaskFighter::of('Wash the dishes', 40, 0);

        $task->tick();

        $this->assertEquals(80, $task->priority);
    }

    public function testSpinTheWorldDoesNotChangePriority()
    {
        $task = TaskFighter::of('Spin the World', 40, 12);

        $task->tick();

        $this->assertEquals(40, $task->priority);
    }

    public function testSpinTheWorldDoesNotChangeDueDate()
    {
        $task = TaskFighter::of('Spin the World', 40, 12);

        $task->tick();

        $this->assertEquals(12, $task->dueIn);
    }
}
