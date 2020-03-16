<?php

namespace Tests\Unit;

use App\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function testItImplementsTheModelClass()
    {
        self::assertInstanceOf(Model::class, new Task());
    }

    public function testItCanGetInstanceOfTask()
    {
        self::assertInstanceOf(Task::class, new Task());
    }

    public function testItDoesntIncreasePriorityOverHundred()
    {
        /** @var Task $task */
        $task = Task::create(['name' => 'Test', 'priority' => 99, 'dueIn' => 100]);
        $task->tick();
        self::assertEquals(100, $task->priority);
        $task->tick();
        self::assertEquals(100, $task->priority);
        $task->delete();
    }

    public function testItDoesntDecreasePriorityBelowZero()
    {
        /** @var Task $task */
        $task = Task::create(['name' => 'Get Older', 'priority' => 1, 'dueIn' => 100]);
        $task->tick();
        self::assertEquals(0, $task->priority);
        $task->tick();
        self::assertEquals(0, $task->priority);
        $task->tick();
        self::assertEquals(0, $task->priority);
        $task->delete();
    }

    public function testItIncreasePriorityOnTick()
    {
        /** @var Task $task */
        $task = Task::create(['name' => 'Test', 'priority' => 50, 'dueIn' => 100]);
        $task->tick();
        self::assertEquals(51, $task->priority);
        $task->tick();
        self::assertEquals(52, $task->priority);
        $task->delete();
    }

    public function testItDecreaseDueOnTick()
    {
        /** @var Task $task */
        $task = Task::create(['name' => 'Test', 'priority' => 50, 'dueIn' => 100]);
        $task->tick();
        self::assertEquals(99, $task->dueIn);
        $task->tick();
        self::assertEquals(98, $task->dueIn);
        $task->delete();
    }

    public function testItDoublePriorityAfterDueOnTick()
    {
        /** @var Task $task */
        $task = Task::create(['name' => 'Test', 'priority' => 0, 'dueIn' => 1]);
        $task->tick();
        self::assertEquals(0, $task->dueIn);
        self::assertEquals(1, $task->priority);
        $task->tick();
        self::assertEquals(-1, $task->dueIn);
        self::assertEquals(3, $task->priority);
        $task->tick();
        self::assertEquals(-2, $task->dueIn);
        self::assertEquals(5, $task->priority);
        $task->delete();
    }

    public function testItDoesntUpdateBreatheTaskOnTick()
    {
        /** @var Task $task */
        $task = Task::create(['name' => 'Breathe', 'priority' => 1000, 'dueIn' => 30]);
        $task->tick();
        self::assertEquals(30, $task->dueIn);
        self::assertEquals(1000, $task->priority);
        $task->tick();
        self::assertEquals(30, $task->dueIn);
        self::assertEquals(1000, $task->priority);
        $task->tick();
        self::assertEquals(30, $task->dueIn);
        self::assertEquals(1000, $task->priority);
        $task->delete();
    }

   public function testItHasNegativePriorityForGetOlderTaskOnTick()
   {
       /** @var Task $task */
       $task = Task::create(['name' => 'Get Older', 'priority' => 6, 'dueIn' => 2]);
       $task->tick();
       self::assertEquals(1, $task->dueIn);
       self::assertEquals(5, $task->priority);
       $task->tick();
       self::assertEquals(0, $task->dueIn);
       self::assertEquals(4, $task->priority);
       $task->tick();
       self::assertEquals(-1, $task->dueIn);
       self::assertEquals(2, $task->priority);
       $task->tick();
       self::assertEquals(-2, $task->dueIn);
       self::assertEquals(0, $task->priority);
       $task->tick();
       self::assertEquals(-3, $task->dueIn);
       self::assertEquals(0, $task->priority);
       $task->delete();
   }

    public function testItChangesPriorityOfCompleteAssessmentTaskOnTick()
    {
        /** @var Task $task */
        $task = Task::create(['name' => 'Complete Assessment', 'priority' => 50, 'dueIn' => 11]);
        $task->tick();
        self::assertEquals(51, $task->priority);
        self::assertEquals(10, $task->dueIn);
        $task->tick();
        self::assertEquals(53, $task->priority);
        self::assertEquals(9, $task->dueIn);
        for($i = 0; $i < 4; $i++) {
            $task->tick();
        }
        self::assertEquals(61, $task->priority);
        self::assertEquals(5, $task->dueIn);
        $task->tick();
        self::assertEquals(64, $task->priority);
        self::assertEquals(4, $task->dueIn);
        for($i = 0; $i < 4; $i++) {
            $task->tick();
        }
        self::assertEquals(76, $task->priority);
        self::assertEquals(0, $task->dueIn);
        $task->tick();
        self::assertEquals(0, $task->priority);
        self::assertEquals(-1, $task->dueIn);
        $task->tick();
        self::assertEquals(0, $task->priority);
        self::assertEquals(-2, $task->dueIn);
        $task->delete();
    }

    /*
     * The following tests are indirectly related to the Task class as they are dependent on the underlying abstract class
     * testItCanAddNewTask
     * testItCanGetATask
     * testItCanUpdateTask
     * testItCanDeleteTask
     */
    public function testItCanAddNewTask()
    {
        /** @var Task $task */
        $task = Task::create(['name' => 'Test', 'priority' => 50, 'dueIn' => 100]);
        self::assertNotNull($task);
        return $task;
    }

    /** @depends testItCanAddNewTask */
    public function testItCanGetATask(Task $task)
    {
        /** @var Task $findTask */
        $findTask = Task::find($task->id);
        self::assertSame($task->id, $findTask->id);
        return $task;
    }

    /** @depends testItCanGetATask */
    public function testItCanUpdateTask(Task $task)
    {
        self::assertSame("Test", $task->name);
        $task->name = "Test 2";
        $task->save();
        $findTask = Task::find($task->id);
        self::assertSame("Test 2", $task->name);
        self::assertSame("Test 2", $findTask->name);
        return $task;
    }

    /** @depends testItCanUpdateTask */
    public function testItCanDeleteTask(Task $task)
    {
        $id = $task->id;
        $task->delete();
        $findTask = Task::find($id);
        self::assertNull($findTask);
    }
}
