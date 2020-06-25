<?php

namespace Tests\Feature;

use Tests\TestCase;

class TaskTest extends TestCase
{
    protected $taskStructure = ['name', 'priority', 'dueIn'];
    protected $taskData = [
        'name' => 'KG',
        'priority' => 4,
        'dueIn' => 9
    ];

    public function testGetTaskList()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/tasks');
        $response->assertOk();
    }

    public function testTaskSave()
    {
        $this->refreshApplication();
        $response = $this->postTask();
        $response->assertJsonStructure($this->taskStructure);
    }

    public function testTaskEdit()
    {
        $newTask = $this->postTask();
        $newTaskResponse = $newTask->decodeResponseJson();
        sleep(1);
        $response = $this->put('/api/tasks/' . $newTaskResponse['id'], $this->taskData);
        $response->assertOk();
    }

    private function postTask() {
        return $this->post('/api/tasks', $this->taskData);
    }
}
