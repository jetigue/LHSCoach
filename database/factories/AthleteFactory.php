<?php

use App\Models\Athlete;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Athlete::class, function (Faker $faker) {
    return [
        'first_name'      => $faker->firstName,
        'last_name'       => $faker->lastName,
        'sex'             => $faker->randomElement(['m', 'f']),
        'dob'             => $faker->date($format = 'Y-m-d'),
        'grad_year'       => $faker->randomElement([2021, 2022, 2023, 2024, 2025]),
        'status'          => $faker->randomElement(['a', 'i']),
        'fall_sport_id'   => $faker->randomElement([null, 1, 2, 3, 4, 5]),
        'winter_sport_id' => $faker->randomElement([null, 1, 2, 3, 4, 5]),
        'spring_sport_id' => $faker->randomElement([null, 1, 2, 3, 4, 5])
    ];
});
