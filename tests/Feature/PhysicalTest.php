<?php

namespace Tests\Feature;

use App\Models\Physical;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PhysicalTest extends TestCase {

    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_add_a_physical()
    {
        $attributes = [
            'athlete_id' => $this->faker->numberBetween($min = 1, $max = 25),
            'history_form' => $this->faker->boolean($chanceOfGettingTrue = 80),
            'physical_exam_form' => $this->faker->boolean($chanceOfGettingTrue = 80),
            'medical_eligibility_form' => $this->faker->boolean($chanceOfGettingTrue = 80),
            'physical_form' => $this->faker->boolean($chanceOfGettingTrue = 80),
            'transportation_waiver_form' => $this->faker->boolean($chanceOfGettingTrue = 80),
            'ghsa_concussion_form' => $this->faker->boolean($chanceOfGettingTrue = 80),
            'ghsa_cardiac_form' => $this->faker->boolean($chanceOfGettingTrue = 80),
            'exam_date' => $this->faker->date($format = 'Y-m-d', $max = 'now') ,
        ];

        $this->post('api/physicals', $attributes);

        $this->assertDatabaseHas('physicals', $attributes);

        $this->get('/physicals')
            ->assertSee($attributes['exam_date']);
    }

    /** @test */
    public function a_physical_requires_an_athlete_id()
    {
        $attributes = factory(Physical::class)->raw(['athlete_id' => '']);

        $this->post('api/physicals', $attributes)->assertSessionHasErrors('athlete_id');
    }

    /** @test */
    public function a_physical_requires_an_exam_date()
    {
        $attributes = factory(Physical::class)->raw(['exam_date' => '']);

        $this->post('api/physicals', $attributes)->assertSessionHasErrors('exam_date');
    }
}