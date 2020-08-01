<?php

namespace App\Http\Controllers\API\Sports;

use App\Http\Controllers\Controller;
use App\Models\Sports\FallSport;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FallSportController extends Controller {


    /**
     * @return FallSport[]|Collection
     */
    public function index()
    {
        return FallSport::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $fallSport = request()->validate([
            'name'   => 'required|string',
        ]);

        $fallSport = FallSport::create($fallSport);

        return response()->json($fallSport, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param FallSport $fallSport
     * @return void
     */
    public function show(FallSport $fallSport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param FallSport $fallSport
     * @return JsonResponse
     */
    public function update(Request $request, FallSport $fallSport)
    {
        request()->validate([
            'name'   => 'required|string'
        ]);

        $fallSport->update(request(['name']));

        return response()->json($fallSport, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FallSport $fallSport
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(FallSport $fallSport)
    {
        $fallSport->delete();

        return response()->json(null, 204);
    }
}
