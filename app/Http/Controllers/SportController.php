<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SportController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index(){

        $sports = Sport::query()->orderBy('season')->orderBy('name')->get();

        return view('sports.index', compact('sports'));
    }
}
