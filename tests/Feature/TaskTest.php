<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePage(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('SendMarc');
    }

    public function testApiIndexPage(): void
    {
        $response = $this->get('/api/task', []);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'priority',
                    'dueIn',
                    'createdAt',
                    'updatedAt',
                ],
            ],
        ]);
    }

    public function testIfCannotCreateTaskWithInvalidData(): void
    {
        $formData = [
            'name'     => 'New Task',
            'priority' => 33,
            'dueIn'    => null,
        ];
        $response = $this->postJson('api/tasks', $formData);

        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function testCreateTaskWithValidData(): void
    {
        $formData = [
            'name'     => 'New Task',
            'priority' => random_int(0, 100),
            'dueIn'    => random_int(1, 360),
        ];
        $response = $this->postJson('api/task', $formData, [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ]);
        $this->assertDatabaseHas('tasks', $formData);
        $response->assertJsonStructure([
            'data' =>
                [
                    'name',
                    'priority',
                    'dueIn',
                    'createdAt',
                    'updatedAt',
                ],
        ]);
    }

    public function testCannotVisitUnknownRoute(): void
    {
        $response1 = $this->get('/unknown-route');
        $response1->assertStatus(404);
        $response1->assertSee('404');
        $response2 = $this->get('/v?mmmm');
        $response2->assertStatus(404);
        $response2->assertSee('404');
    }

    public function testTaskTickRoute(): void
    {
        $response = $this->get('/list/tick', []);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'priority',
                    'dueIn',
                    'createdAt',
                    'updatedAt',
                ],
            ],
        ]);
    }

}
