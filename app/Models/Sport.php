<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Sport extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'season'
    ];


    /**
     * @return BelongsToMany
     */
    public function athletes()
    {
        return $this->belongsToMany(Athlete::class);
    }
}
