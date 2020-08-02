<?php

namespace Tests\Feature;

use App\Models\Athlete;
use App\Models\Sports\FallSport;
use App\Models\Sports\SpringSport;
use App\Models\Sports\WinterSport;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AthleteTest extends TestCase {

    use WithFaker, RefreshDatabase;

    protected $fallSport;
    protected $winterSport;
    protected $springSport;
    protected $attributes;
    protected $newAttributes;

    public function setUp(): void
    {
        parent::setUp();

        $this->fallSport = factory(FallSport::class)->create();
        $this->winterSport = factory(WinterSport::class)->create();
        $this->springSport = factory(SpringSport::class)->create();

        $this->attributes = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'sex' => $this->faker->randomElement(['m', 'f']),
            'dob' => $this->faker->date($format = 'Y-m-d'),
            'grad_year' => $this->faker->randomElement([2021, 2022, 2023, 2024, 2025]),
            'fall_sport_id' => $this->fallSport->id,
            'winter_sport_id' => $this->winterSport->id,
            'spring_sport_id' => $this->springSport->id,
        ];

        $this->newAttributes = [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'sex' => 'f',
            'dob' => $this->faker->date($format = 'Y-m-d'),
            'grad_year' => $this->faker->randomElement([2021, 2022, 2023, 2024, 2025]),
            'fall_sport_id' => $this->fallSport->id,
            'winter_sport_id' => $this->winterSport->id,
            'spring_sport_id' => $this->springSport->id,
        ];
    }

    /** @test */
    public function a_user_can_create_an_athlete()
    {
        $this->post('api/athletes', $this->attributes)->assertStatus(201);

        $this->assertDatabaseHas('athletes', $this->attributes);

        $this->get('/athletes')
            ->assertSee($this->attributes['first_name'])
            ->assertSee($this->attributes['last_name']);
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
    public function an_athlete_requires_a_fall_sport_id()
    {
        $attributes = factory(Athlete::class)->raw(['fall_sport_id' => '']);

        $this->post('api/athletes', $attributes)->assertSessionHasErrors('fall_sport_id');
    }

    /** @test */
    public function an_athlete_requires_a_winter_sport_id()
    {
        $attributes = factory(Athlete::class)->raw(['winter_sport_id' => '']);

        $this->post('api/athletes', $attributes)->assertSessionHasErrors('winter_sport_id');
    }

    /** @test */
    public function an_athlete_requires_a_spring_sport_id()
    {
        $attributes = factory(Athlete::class)->raw(['spring_sport_id' => '']);

        $this->post('api/athletes', $attributes)->assertSessionHasErrors('spring_sport_id');
    }
}
