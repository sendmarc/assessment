<?php

namespace Tests\Unit;

use App\TaskFighterModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
//    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testListTasksRedirectsToTasks()
    {
       $this->get('/')->assertRedirect('/tasks');
    }

    public function testCanCreateTask()
    {
        $this->withoutExceptionHandling();

        $formData = [
            'name'     => 'Task',
            'priority' => 10,
            'dueIn'    => 65
            ];
        $response = $this->post(route('tasks.store'),$formData);
        $status = $response->getStatusCode();
        $this->assertEquals(200,$status,$response->getContent());

    }

    public function testCanDeleteTask()
    {
        $this->get(route('delete',1))
            ->assertStatus(200);
    }

    public function testCanCauseTaskToTick()
    {

    }
}
