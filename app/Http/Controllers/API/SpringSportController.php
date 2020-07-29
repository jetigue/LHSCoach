<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sports\SpringSport;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SpringSportController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return SpringSport::orderBy('name')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $springSport = request()->validate([
            'name'   => 'required|string',
        ]);

        $springSport = SpringSport::create($springSport);

        return response()->json($springSport, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param SpringSport $springSport
     * @return void
     */
    public function show(SpringSport $springSport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param SpringSport $springSport
     * @return JsonResponse
     */
    public function update(Request $request, SpringSport $springSport)
    {
        request()->validate([
            'name'   => 'required|string'
        ]);

        $springSport->update(request(['name']));

        return response()->json($springSport, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SpringSport $springSport
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(SpringSport $springSport)
    {
        $springSport->delete();

        return response()->json(null, 204);
    }
}