<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('SendMarc');
    }

    public function testApiIndexPage()
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
        $response = $this->postJson('api/tasks', $formData);
        $this->assertDatabaseHas('tasks', $formData);
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

    public function testCannotVisitUnknownRoute()
    {
        $response1 = $this->get('/unknown-route');
        $response1->assertStatus(404);
        $response1->assertSee('404');
        $response2 = $this->get('/v?mmmm');
        $response2->assertStatus(404);
        $response2->assertSee('404');
    }

    public function testTaskTickRoute()
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
