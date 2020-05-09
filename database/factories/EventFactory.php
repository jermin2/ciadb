<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use App\Eventtype;
use Faker\Generator as Faker;
use App\User;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'time' => $faker->dateTimeThisYear,
        'name' => $faker->catchPhrase,
        'location' => $faker->streetName,
        'notes' => $faker->text(200),
        'author_id' => User::all()->random()
    ];
});
