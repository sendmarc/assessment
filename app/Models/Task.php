<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 *
 * @package App
 * @property string $name
 * @property int $priority
 * @property int $dueIn
 */
class Task extends Model
{
    public $timestamps = false;
    protected $table = 'tasks';
    protected $fillable = ['name', 'priority', 'dueIn'];
}
