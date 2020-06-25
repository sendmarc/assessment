<?php

namespace Tests\Feature;

use Tests\TestCase;

class TaskTest extends TestCase
{
    public function testGetTaskList()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/tasks');
        $response->assertOk();
    }
}
