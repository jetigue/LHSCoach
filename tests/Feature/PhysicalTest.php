<?php

namespace Tests\Feature;

use App\Models\Athlete;
use App\Models\Physical;
use App\Models\Sports\FallSport;
use App\Models\Sports\SpringSport;
use App\Models\Sports\WinterSport;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PhysicalTest extends TestCase {

    use WithFaker, RefreshDatabase;

    protected $athlete;
    protected $attributes;
    protected $newAttributes;

    public function setUp(): void
    {
        parent::setUp();
        $fallSport = factory(FallSport::class)->create();
        $winterSport = factory(WinterSport::class)->create();
        $springSport = factory(SpringSport::class)->create();

        $this->athlete = factory(Athlete::class)->create([
            'fall_sport_id' => $fallSport->id,
            'spring_sport_id' => $springSport->id,
            'winter_sport_id' => $winterSport->id
        ]);

        $this->attributes = [
            'athlete_id' => $this->athlete->id,
            'history_form' => 1,
            'physical_exam_form' => 1,
            'medical_eligibility_form' => 1,
            'physical_form' => 1,
            'blanket_waiver_form' => 1,
            'ghsa_concussion_form' => 1,
            'ghsa_cardiac_form' => 1,
            'exam_date' => '2020-01-01',
        ];

        $this->newAttributes = [
            'athlete_id' => $this->athlete->id,
            'history_form' => 0,
            'physical_exam_form' => 0,
            'medical_eligibility_form' => 0,
            'physical_form' => 0,
            'blanket_waiver_form' => 0,
            'ghsa_concussion_form' => 0,
            'ghsa_cardiac_form' => 0,
            'exam_date' => '2019-06-25',
        ];
    }

    /** @test */
    public function a_user_can_add_a_physical()
    {

        $this->post('/api/physicals', $this->attributes)->assertStatus(201);

        $this->assertDatabaseHas('physicals', $this->attributes);

        $this->get('/physicals')
            ->assertSee($this->attributes['exam_date']);
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
