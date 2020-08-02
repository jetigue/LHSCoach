<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AthleteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Athlete::whereBetween('grad_year', [2021, 2025])
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->with('fallSport')
            ->with('springSport')
            ->with('winterSport')
            ->paginate(50);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $athlete = request()->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'sex' => 'required|in:m,f',
            'dob' => 'required|date',
            'grad_year' => 'required|integer',
            'fall_sport_id' => 'required|integer',
            'winter_sport_id' => 'required|integer',
            'spring_sport_id' => 'required|integer'
        ]);

        $athlete = Athlete::create($athlete);

        return response()->json($athlete, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Athlete $athlete
     * @return \Illuminate\Http\Response
     */
    public function show(Athlete $athlete)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Athlete $athlete
     * @return JsonResponse
     */
    public function update(Request $request, Athlete $athlete)
    {
        request()->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'sex' => 'required|in:m,f',
            'dob' => 'required|date',
            'grad_year' => 'required|integer',
            'fall_sport_id' => 'required|integer',
            'winter_sport_id' => 'required|integer',
            'spring_sport_id' => 'required|integer'
        ]);

        $athlete->update(request([
            'first_name',
            'last_name',
            'sex',
            'dob',
            'grad_year',
            'fall_sport_id',
            'winter_ports_id',
            'spring_sport_id'
        ]));

        return response()->json($athlete, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Athlete $athlete
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Athlete $athlete)
    {
        $athlete->delete();

        return response()->json(null, 204);
    }
}
