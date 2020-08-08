<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Physical extends Model
{
    protected $fillable = [
            'athlete_id',
            'history_form',
            'physical_exam_form',
            'medical_eligibility_form',
            'physical_form',
            'blanket_waiver_form',
            'ghsa_concussion_form',
            'ghsa_cardiac_form',
            'exam_date',
            'restrictions',
            'notes',
            'form_path'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
        protected $dates = [
            'exam_date',
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'exam_date' => 'datetime:Y-m-d',
    ];

    /**
     * @var string[]
     */
    protected $appends = ['athlete_name', 'physical_status'];

    /**
     * @return string
     */
    public function getAthleteNameAttribute()
    {
        return $this->athlete->last_name . ', ' . $this->athlete->first_name;
    }

    public function getPhysicalStatusAttribute()
    {
        if
            (
                $this->history_form === 1 &&
                $this->physical_exam_form === 1 &&
                $this->medical_eligibility_form === 1 &&
                $this->physical_form === 1 &&
                $this->blanket_waiver_form === 1 &&
                $this->ghsa_concussion_form === 1 &&
                $this->ghsa_cardiac_form === 1 &&
                $this->restrictions === null
            )
        { return "Cleared";}

        elseif
        (
            $this->history_form === 1 &&
            $this->physical_exam_form === 1 &&
            $this->medical_eligibility_form === 1 &&
            $this->physical_form === 1 &&
            $this->blanket_waiver_form === 1 &&
            $this->ghsa_concussion_form === 1 &&
            $this->ghsa_cardiac_form === 1 &&
            $this->restrictions !== null
        ) {
            return "Cleared with Restrictions";
        }
        return "Not Cleared";
    }

    /**
     * @return BelongsTo
     */
    public function athlete()
    {
        return $this->belongsTo(Athlete::class, 'athlete_id');

    }
}
