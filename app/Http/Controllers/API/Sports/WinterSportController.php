<?php

namespace App\Http\Controllers\API\Sports;

use App\Http\Controllers\Controller;
use App\Models\Sports\WinterSport;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WinterSportController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return WinterSport[]|Collection
     */
    public function index()
    {
        return WinterSport::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $winterSport = request()->validate([
            'name'   => 'required|string',
        ]);

        $winterSport = WinterSport::create($winterSport);

        return response()->json($winterSport, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param WinterSport $winterSport
     * @return void
     */
    public function show(WinterSport $winterSport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param WinterSport $winterSport
     * @return JsonResponse
     */
    public function update(Request $request, WinterSport $winterSport)
    {
        request()->validate([
            'name'   => 'required|string'
        ]);

        $winterSport->update(request(['name']));

        return response()->json($winterSport, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param WinterSport $winterSport
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(WinterSport $winterSport)
    {
        $winterSport->delete();

        return response()->json(null, 204);
    }
}
