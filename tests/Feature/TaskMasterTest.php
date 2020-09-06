<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskMasterTest extends TestCase
{
    /**
     * test we get the home page.
     *
     * @return void
     */
    public function testHomePage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test we have data and can select it.
     *
     * @return void
     */
    public function testSelectAll()
    {
        $response = $this->get('/tasks');

        $response->assertStatus(200);
    }

    /**
     * Test the ticker is working.
     *
     * @return void
     */
    public function testTicker()
    {
        $response = $this->get('/tick');

        $response->assertStatus(200);
    }
}
