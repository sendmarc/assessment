<?php

namespace App\Http\Controllers;

use DB;
use App\Tasks;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;

class TasksController extends Controller
{	
    public function index()
    {
        return response(Tasks::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function create(Generator $faker)
    {
        $task = new Tasks();
        $task->name = $faker->lexify('????????');
        $task->save();

        return response($task->jsonSerialize(), Response::HTTP_CREATED);
    }
	
	public function update($id)
    {
        $task = Tasks::findOrFail($id);
		
		if ($task->name == 'Get Older' || $task->name == 'Breathe' || $task->name == 'Complete Assessment') {
			if ($task->dueIn >= 0) {
				if ($task->name == 'Get Older') {
					$task->priority -= 1;
					$task->dueIn -= 1;
				}
				if ($task->name == 'Complete Assessment') {
					if ($task->dueIn < 11 && $task->dueIn > 5) {
						$task->priority += 2;
						$task->dueIn -= 1;
					}
					elseif ($task->dueIn < 6 && $task->dueIn > 0) {
						$task->priority += 3;
						$task->dueIn -= 1;
					}
					elseif ($task->dueIn == 0) {
						$task->priority = 0;
					}
					else {
						$task->priority += 1;
						$task->dueIn -= 1;
					}
				}
			}
		}
		else {
			if ($task->dueIn == 0) {
				$task->priority += 2;
			}
			else {
				if ($task->priority <= 100 && $task->priority >= 0) {
					$task->priority += 1;
				}
				
				if ($task->dueIn >= 0) {
					$task->dueIn -= 1;
				}
			}
		}
		
        $task->save();

        return response($task->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function destroy($id)
    {
        Tasks::destroy($id);
		
		DB::statement("ALTER TABLE `tasks` AUTO_INCREMENT=0");

        return response(null, Response::HTTP_OK);
    }
}
