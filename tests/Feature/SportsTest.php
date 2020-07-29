<?php

namespace Tests\Feature;

use App\Models\Sport;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SportsTest extends TestCase {

    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_sport()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => $this->faker->word,
            'season' => $this->faker->randomElement(['fall', 'winter', 'spring']),
        ];

        $this->post('api/sports', $attributes);

        $this->assertDatabaseHas('sports', $attributes);

        $this->get('/sports')
            ->assertSee($attributes['name'])
            ->assertSee($attributes['season']);
    }

    /** @test */
    public function a_sport_requires_a_name()
    {
        $attributes = factory(Sport::class)->raw(['name' => '']);

        $this->post('api/sports', $attributes)->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_sport_requires_a_season()
    {
        $attributes = factory(Sport::class)->raw(['season' => '']);

        $this->post('api/sports', $attributes)->assertSessionHasErrors('season');
    }

    /** @test */
    public function a_sport_requires_a_valid_season()
    {
        $attributes = factory(Sport::class)->raw(['season' => 'summer']);

        $this->post('api/sports', $attributes)->assertSessionHasErrors('season');
    }
}