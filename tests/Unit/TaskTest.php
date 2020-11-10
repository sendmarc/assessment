<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetOlder()
    {
    	$task = Task::where('name', 'Get Older')->first();
    	
    	$due = $task->dueIn;
    	$priority = $task->priority;

    	$task->tick();

        $this->assertTrue($task->priority < $priority);
        $this->assertTrue($task->dueIn < $dueIn);
    }

    public function testCompleteAssignment()
    {
    	$task = Task::where('name', 'Complete Assignment')->first();
    	
    	$due = $task->dueIn;
    	$priority = $task->priority;

    	$task->tick();

        $this->assertTrue($task->priority > $priority);
        $this->assertTrue($task->dueIn < $dueIn);
    }

    public function testBreathe()
    {
    	$task = Task::where('name', 'Breathe')->first();
    	
    	$due = $task->dueIn;
    	$priority = $task->priority;

    	$task->tick();

        $this->assertTrue($task->priority == 1000);
    }
}
