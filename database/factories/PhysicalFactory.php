<?php

use App\Models\Physical;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Physical::class, function (Faker $faker) {
    return [
        'athlete_id'                 => $this->faker->numberBetween($min = 1, $max = 25),
        'history_form'               => $this->faker->boolean($chanceOfGettingTrue = 80),
        'physical_exam_form'         => $this->faker->boolean($chanceOfGettingTrue = 80),
        'medical_eligibility_form'   => $this->faker->boolean($chanceOfGettingTrue = 80),
        'physical_form'              => $this->faker->boolean($chanceOfGettingTrue = 80),
        'transportation_waiver_form' => $this->faker->boolean($chanceOfGettingTrue = 80),
        'ghsa_concussion_form'       => $this->faker->boolean($chanceOfGettingTrue = 80),
        'ghsa_cardiac_form'          => $this->faker->boolean($chanceOfGettingTrue = 80),
        'exam_date'                  => $this->faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});
