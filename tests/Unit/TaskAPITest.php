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

        $response->assertStatus(302);
    }
}
