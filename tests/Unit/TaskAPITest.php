<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Task;

class TaskAPITest extends TestCase
{

    public function testRootNav()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testNameUnique()
    {
        $response = $this->json('POST', '/tasks', ['name' => 'Test Unique']);
        $id = $response->json();
        $response->assertStatus(200);

        $response = $this->json('POST', '/tasks', ['name' => 'Test Unique']);
        $response->assertStatus(422);

        Task::destroy($id);
    }

    public function testNoName()
    {
        $response = $this->json('POST', '/tasks', ['name' => null]);
        $response->assertStatus(422);

        $response = $this->json('POST', '/tasks', ['priority' => 1]);
        $response->assertStatus(422);
    }

    public function testDueDefault()
    {
        $response = $this->json('POST', '/tasks', ['name' => 'Test Default Due', 'priority' => 50]);
        $id = $response->json();
        $response->assertStatus(200);
        $this->assertArrayHasKey('dueIn', Task::find($id));
        Task::destroy($id);
    }

    public function testPriorityDefault()
    {
        $response = $this->json('POST', '/tasks', ['name' => 'Test Default Priority', 'dueIn' => 50]);
        $id = $response->json();
        $response->assertStatus(200);
        $this->assertArrayHasKey('priority', Task::find($id));
        Task::destroy($id);
    }

    public function testValidationRegex()
    {
        // Only space, period and alaphanumeric characters should work
        $response = $this->json('POST', '/tasks', ['name' => 'Tasky*']);
        $response->assertStatus(422);

        // Zero length should fail
        $response = $this->json('POST', '/tasks', ['name' => '']);
        $response->assertStatus(422);

        $response = $this->json('POST', '/tasks', ['name' => '1 Tasky .']);
        $response->assertStatus(200);
        $id = $response->json();
        Task::destroy($id);
    }
}
