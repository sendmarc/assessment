<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Task;

class TaskFighterController extends Controller
{
    public function index()
    {
        return Task::all();
    }
}
