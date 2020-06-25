<?php

namespace Tests\Feature;

use Tests\TestCase;

class TaskTest extends TestCase
{
    protected $taskStructure = ['name', 'priority', 'dueIn'];

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
        $response = $this->put('/api/tasks/' . $newTaskResponse['id'], $this->getTaskData());
        $response->assertOk();
    }

    public function testTaskDelete()
    {
        $newTask = $this->postTask();
        $newTaskResponse = $newTask->decodeResponseJson();
        $response = $this->delete('/api/tasks/' . $newTaskResponse['id'], $this->getTaskData());
        $response->assertOk();
    }

    public function testTaskTick()
    {
        $response = $this->get('/api/list/tick');
        $response->assertOk();
        $response->assertJsonStructure(['*' => $this->taskStructure]);
    }

    private function postTask() {
        return $this->post('/api/tasks', $this->getTaskData());
    }

    private function getTaskData()
    {
        return [
            'name' => 'KG' . rand(1, 1000),
            'priority' => 4,
            'dueIn' => 9
        ];
    }
}
