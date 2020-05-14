<?php

namespace Tests\Unit;

use App\TaskFighter;
use App\TaskFighterModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{

    use RefreshDatabase;
    protected $tasks;
    public function setUp(): void
    {
        parent::setUp();
        $this->tasks = TaskFighterModel::create([
            'name'=> 'Test',
            'priority' => 100,
            'dueIn'    => 365
        ]);

    }

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
            'name'     => 'Test 1',
            'priority' => 100,
            'dueIn'    => 365
            ];

        $this->post(route('tasks.store'),$formData)
            ->assertOk()
            ->assertJson(['message'=>"Task Created Successfully!!!"]);
    }

    public function testCanDeleteTask()
    {
        $task_id = $this->tasks->id;
        $this->get(route('delete',$task_id))
        ->assertOk();
    }

    public function testCanCauseTaskToTick()
    {
        $this->get(route('task-tick'))
            ->assertOk();
    }
}
