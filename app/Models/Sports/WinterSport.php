<?php

namespace App\Models\Sports;

use Illuminate\Database\Eloquent\Model;

class WinterSport extends Model
{
    protected $table = 'winter_sports';

    protected $fillable = ['name'];
}