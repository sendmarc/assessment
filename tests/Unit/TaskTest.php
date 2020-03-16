<?php

namespace Tests\Unit;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testItImplementsTheModelClass()
    {

    }

    public function testItCanGetInstanceOfTask()
    {

    }

    public function testItDoesntIncreasePriorityOverHundred()
    {
        //Add task with priority 99
        //Tick twice
        //Check priority = 100
    }

    public function testItDoesntDecreasePriorityBelowZero()
    {
        //Retrieve get older task
        //Change priority to 1
        //Tick twice
        //Check priority = 0;
    }

    public function testItIncreasePriorityOnTick()
    {
        //Create task
        //Tick
        //Check priority
    }

    public function testItDecreaseDueOnTick()
    {
        //Create task
        //Tick
        //Check due
    }

    public function testItDoublePriorityAfterDueOnTick()
    {
        //Create task with due = 1 and priority = 0
        //Tick
        //due should 0 and priority should 1
        //Tick
        //due should -1 and priority should 3
        //Tick
        //due should -2 and priority should 5
    }

    public function testItDoesntUpdateBreatheTaskOnTick()
    {
        //Get breathe task
        //Tick
        //Check breathe task values
    }

   public function testItHasNegativePriorityForGetOlderTaskOnTick()
   {
       //Get get older task
       //Set due in to 1
       //Tick
       //Priority should decrease
       //Tick
       //Priority should deacrease by 2
   }

    public function testItChangesPriorityOfCompleteAssessmentTaskOnTick()
    {
        //Get assessment task
        //Set due = 11; priority = 50
        //Tick
        //Check changed by one
        //Tick
        //Check changed by 2
        //Tick * 4
        //Check changed by 8
        //Tick
        //Check changed by 3
        //Tick * 4
        //Check change by 12
        //Tick
        //Check priority is 0
        //Tick
        //Check priority remains at 0

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

        return $task;
    }

    /** @depends testItCanAddNewTask */
    public function testItCanGetATask(Task $task)
    {

        return $task;
    }

    /** @depends testItCanAddNewTask */
    public function testItCanUpdateTask(Task $task)
    {

        return $task;
    }

    /** @depends testItCanUpdateTask */
    public function testItCanDeleteTask(Task $task)
    {

    }
}
