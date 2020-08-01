<?php

namespace App\Http\Controllers\Sports;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\Sports\SpringSport;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class SpringSportController extends Controller
{
    /**
     * @param SpringSport $springSport
     * @return Application|Factory|View
     */
    public function show(SpringSport $springSport)
    {
        $athletes = Athlete::where('winter_sport_id', $springSport->id)
            ->orderBy('last_name')->orderBy('first_name')
            ->with('latestPhysical')
            ->get();

        return view('sports.spring.show', compact('springSport', 'athletes'));
    }
}
