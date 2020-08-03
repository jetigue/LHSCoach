<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AthletePhysicalController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Athlete::whereBetween('grad_year', [2021, 2025])
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->with('fallSport')
            ->with('springSport')
            ->with('winterSport')
            ->get();
    }
}
