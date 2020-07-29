<?php

use App\Models\Sports\FallSport;
use App\Models\Sports\SpringSport;
use App\Models\Sports\WinterSport;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(FallSport::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});

/** @var Factory $factory */
$factory->define(WinterSport::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});

/** @var Factory $factory */
$factory->define(SpringSport::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
