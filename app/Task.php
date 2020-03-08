<?php

namespace App;

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
    protected $fillable = ['priority'];
}
