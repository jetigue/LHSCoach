<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Physical;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class AthleteController extends Controller
{

    /**
     * @return Application|Factory|View
     */
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

    public function show(Athlete $athlete)
    {
        $physicals = Physical::where('athlete_id', $athlete->id)
            ->orderBy('exam_date', 'desc')
            ->with('athlete')
            ->get();

        return view('athletes.show', compact('athlete', 'physicals'));
    }

}
