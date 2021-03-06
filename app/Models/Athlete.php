<?php

namespace App\Models;

use App\Models\Sports\FallSport;
use App\Models\Sports\SpringSport;
use App\Models\Sports\WinterSport;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Athlete extends Model
{

    /**
     * @var string
     */
    protected $table = 'athletes';

    /**
     * @var string[]
     */
    protected $appends = ['age', 'grade', 'gender'];

    /**
     * @var array
     */
    protected $fillable = ([
        'first_name',
        'last_name',
        'sex',
        'dob',
        'grad_year',
        'status',
        'fall_sport_id',
        'winter_sport_id',
        'spring_sport_id'
    ]);

    /**
     * @var string[]
     */
    protected $casts = ['dob' => 'date:Y-m-d'];

    /**
     * @return BelongsTo
     */
    public function fallSport()
    {
        return $this->belongsTo(FallSport::class);
    }

    /**
     * @return BelongsTo
     */
    public function winterSport()
    {
        return $this->belongsTo(WinterSport::class);
    }

    /**
     * @return BelongsTo
     */
    public function springSport()
    {
        return $this->belongsTo(SpringSport::class);
    }

    /**
     * @return HasMany
     */
    public function physicals()
    {
        return $this->hasMany(Physical::class);
    }

    /**
     * @return HasOne
     */
    public function latestPhysical()
    {
        return $this->hasOne(Physical::class)->latest('exam_date');
    }

    /**
     * @return string
     */
    public function getGenderAttribute()
    {
        if ($this->sex == "f") {
            return "Female";
        }
        return "Male";
    }

    /**
     * @return mixed
     */
    public function getAgeAttribute()
    {
        return $this->dob->diffInYears(Carbon::now());
    }

    public function getGradeAttribute()
    {
        $m = Carbon::now()->month;
        $y = Carbon::now()->year;
        $gy = $this->grad_year;

        switch($m)
        {
            case $m >= 6:
                if ($gy - $y === 5)
                { return 8; }

                else if ($gy - $y === 4)
                { return 9; }

                elseif ($gy - $y === 3)
                { return 10; }

                elseif ($gy - $y === 2)
                { return 11; }

                elseif ($gy - $y === 1)
                { return 12; }

                elseif ($gy - $y <= 0)
                { return 'alum'; }

                else { return ''; }
            case $m <= 5:
                if ($gy - $y === 4)
                { return 8; }

                elseif ($gy - $y === 3)
                { return 9; }

                elseif ($gy - $y === 2)
                { return 10; }

                elseif ($gy - $y === 1)
                { return 11; }

                elseif ($gy - $y === 0)
                { return 12; }

                else { return 'alum'; }
        }

    }

//    public function getPhysicalStatusAttribute()
//    {
//        if ($this->latestPhysical === null)
//        {
//            return 'Not Cleared';
//        }
//        return $this->latestPhysical->physical_status;
//    }

    /**
     * Save a slug on store and update
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($athlete) {

            $athlete->slug = Str::slug(
                $athlete->first_name . '-' . $athlete->last_name . '-' . $athlete->grad_year
            );
        });
    }
}
