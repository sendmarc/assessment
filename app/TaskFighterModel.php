<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskFighterModel extends Model
{

    protected $table = 'tasks';
    public $timestamps = true;
    protected $fillable =['name','priority','dueIn'];

}
