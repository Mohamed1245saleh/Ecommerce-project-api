<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Test;
use Faker\Generator as Faker;

$factory->define(Test::class, function (Faker $faker) {
    return [
       'id'   => $faker->unique()->numberBetween(0,100),
       'name' => $faker->text(10)
    ];
});
