<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Sports\FallSport;
use App\Models\Sports\SpringSport;
use App\Models\Sports\WinterSport;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SportController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $fallSports = FallSport::orderBy('name')->get();
        $winterSports = WinterSport::orderBy('name')->get();
        $springSports = SpringSport::orderBy('name')->get();



        return view('sports.index', compact('fallSports', 'winterSports', 'springSports'));
    }
}
