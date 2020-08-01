<?php

namespace App\Models\Sports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SpringSport extends Model
{
    protected $table = 'spring_sports';

    protected $fillable =['name'];

    /**
     * Save a slug on store and update
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($sport) {

            $sport->slug = Str::slug(
                $sport->name . '-' . 'spring'
            );
        });
    }
}
