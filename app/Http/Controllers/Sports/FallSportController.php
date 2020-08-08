<?php

namespace App\Http\Controllers\Sports;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\Sports\FallSport;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class FallSportController extends Controller
{

    /**
     * @param FallSport $fallSport
     * @return Application|Factory|View
     */
    public function show(FallSport $fallSport)
    {
        $athletes = Athlete::where('fall_sport_id', $fallSport->id)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->with('latestPhysical')
            ->get();

        return view('sports.fall.show', compact('fallSport', 'athletes'));
    }
}
