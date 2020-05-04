<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'time' => $faker->dateTimeThisYear,
        'name' => $faker->catchPhrase,
        'location' => $faker->streetName,
        'notes' => $faker->text(200),
    ];
});
