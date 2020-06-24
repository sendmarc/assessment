<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'priority' => $faker->numberBetween(0, 100),
        'dueIn' => $faker->numberBetween(0, 100),
    ];
});
