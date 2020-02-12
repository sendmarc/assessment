<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Task;

class TaskFighterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testPriority(Task $task)
    {
        if($task->name == 'Breathe')
        {
            $this->assertEquals($task->priority, 1000);
        }
        else
        {
            $this->assertTrue($task->priority >= 0 && $task->priority <= 100);
        }
    }

}
