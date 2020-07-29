<?php

namespace App\Models\Sports;

use Illuminate\Database\Eloquent\Model;

class SpringSport extends Model
{
    protected $table = 'spring_sports';

    protected $fillable =['name'];
}