<?php

namespace App\Models\Sports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FallSport extends Model
{
    protected $table = 'fall_sports';

    protected $fillable = ['name'];

    /**
     * Save a slug on store and update
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($sport) {

            $sport->slug = Str::slug(
                $sport->name . '-' . 'fall'
            );
        });
    }
}
