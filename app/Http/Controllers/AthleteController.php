<?php

namespace App\Http\Controllers;

use App\Models\Athlete;

class AthleteController extends Controller
{

    public function index()
    {
        $athletes = Athlete::query()
            ->with('latestPhysical')
            ->with('fallSport')
            ->with('winterSport')
            ->with('springSport')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        return view('athletes.index', compact('athletes'));
    }

}