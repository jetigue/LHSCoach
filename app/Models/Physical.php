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
            'notes'
    ];

    /**
     * @return BelongsTo
     */
    public function athlete()
    {
        return $this->belongsTo(Athlete::class, 'athlete_id');

    }
}
