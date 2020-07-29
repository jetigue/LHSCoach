<?php

namespace Tests\Feature;

use App\Models\Athlete;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AthleteTest extends TestCase {

    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_an_athlete()
    {
        $attributes = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'sex' => $this->faker->randomElement(['m', 'f']),
            'dob' => $this->faker->date($format = 'Y-m-d'),
            'grad_year' => $this->faker->randomElement([2021, 2022, 2023, 2024, 2025]),
            'status' => $this->faker->randomElement(['a', 'i']),
        ];

        $this->post('api/athletes', $attributes);

        $this->assertDatabaseHas('athletes', $attributes);

        $this->get('/athletes')
            ->assertSee($attributes['first_name'])
            ->assertSee($attributes['last_name']);
    }

    /** @test */
    public function an_athlete_requires_a_first_name()
    {
        $attributes = factory(Athlete::class)->raw(['first_name' => '']);

        $this->post('api/athletes', $attributes)->assertSessionHasErrors('first_name');
    }

    /** @test */
    public function an_athlete_requires_a_last_name()
    {
        $attributes = factory(Athlete::class)->raw(['last_name' => '']);

        $this->post('api/athletes', $attributes)->assertSessionHasErrors('last_name');
    }

    /** @test */
    public function an_athlete_requires_a_sex()
    {
        $attributes = factory(Athlete::class)->raw(['sex' => '']);

        $this->post('api/athletes', $attributes)->assertSessionHasErrors('sex');
    }

    /** @test */
    public function an_athlete_requires_a_dob()
    {
        $attributes = factory(Athlete::class)->raw(['dob' => '']);

        $this->post('api/athletes', $attributes)->assertSessionHasErrors('dob');
    }

    /** @test */
    public function an_athlete_requires_a_grad_year()
    {
        $attributes = factory(Athlete::class)->raw(['grad_year' => '']);

        $this->post('api/athletes', $attributes)->assertSessionHasErrors('grad_year');
    }

    /** @test */
    public function an_athlete_requires_a_status()
    {
        $attributes = factory(Athlete::class)->raw(['status' => '']);

        $this->post('api/athletes', $attributes)->assertSessionHasErrors('status');
    }
}