<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Controllers;

class TasksTest extends TestCase
{
	use WithFaker;
    /*
	 * @test 
     */
    public function test_read_all_tasks()
    {
        $response = $this->get('/api/tasks');
		
		$response->assertStatus(200);
    }
	
	/*
	 * @test
	 */
	public function test_create_task()
	{
		$response = $this->get('/api/tasks/create');
		
		$data = json_decode($response->getContent());
        
        $response->assertSee($data->name);
		
		$this->assertTrue(true);
	}
	
	/*
	 * @test
	 */
	public function test_tick_task()
	{
		$response = $this->json('PUT','/api/tasks/6', [
			'name' => 'Test'
		]);
        
		$this->assertTrue(true);
	}
	
	/*
	 * @test
	 */
	public function test_delete_task()
	{
		$response = $this->json('DELETE','/api/tasks/9');
        
		$response->assertStatus(200);
	}
}
