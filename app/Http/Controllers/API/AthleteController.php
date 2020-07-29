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
        //
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
            'last_name'  => 'required|string',
            'sex'        => 'required|in:m,f',
            'dob'        => 'required|date',
            'grad_year'  => 'required|integer',
            'status'     => 'required|in:a,i',
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
            'last_name'  => 'required|string',
            'sex'        => 'required|in:m,f',
            'dob'        => 'required|date',
            'grad_year'  => 'required|integer',
            'status'     => 'required|in:a,i'
        ]);

        $athlete->update(request([
            'first_name',
            'last_name',
            'sex',
            'dob',
            'grad_year',
            'status'
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