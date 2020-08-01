<?php

namespace App\Http\Controllers\Sports;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\Sports\WinterSport;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class WinterSportController extends Controller
{
    /**
     * @param WinterSport $winterSport
     * @return Application|Factory|View
     */
    public function show(WinterSport $winterSport)
    {
        $athletes = Athlete::where('winter_sport_id', $winterSport->id)
            ->orderBy('last_name')->orderBy('first_name')
            ->with('latestPhysical')
            ->get();

        return view('sports.winter.show', compact('winterSport', 'athletes'));
    }
}
