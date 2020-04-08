<?php

namespace Tests\Unit;
use App\TaskFighter;
use PHPUnit\Framework\TestCase;

class TaskFighterTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testIfTickArrayHasdueInKey()
    {
        $taskFighter = new TaskFighter();
        $this->assertArrayHasKey('dueIn', $taskFighter->tick('Get Older', 10, 10));
    }
    public function testIfTickArrayHasPriorityKey()
    {
        $taskFighter = new TaskFighter();
        $this->assertArrayHasKey('priority', $taskFighter->tick('Complete Assessment', 10, 10));
    }
    public function testIfTickPriorityMoreThanHundred()
    {
        $taskFighter = new TaskFighter();
        $this->assertContains(200, $taskFighter->tick('Complete Assessment', 200, 10));
    }

    public function testIfTickNegativePriority()
    {
        $taskFighter = new TaskFighter();
        $this->assertContains(-200, $taskFighter->tick('Get Older', -200, 10));
   
    }
    public function testIfBreathePriorityChanges()
    {
        $taskFighter = new TaskFighter();
        $this->assertContains(10, $taskFighter->tick('Breathe', 10, 10));
   
    }


}
