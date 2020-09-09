<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Physical;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PhysicalController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return LengthAwarePaginator
     */
    public function index()
    {
        $ly = Carbon::now()->year - 1;

        return Physical::with(['athlete' => function ($q) {
            $q->orderBy('last_name')->orderBy('first_name');
        }])
            ->whereYear('exam_date', '>=', $ly)
            ->paginate(100);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $physical = request()->validate ([
            'athlete_id' => 'required|integer',
            'history_form' => 'required|boolean',
            'physical_exam_form' => 'required|boolean',
            'medical_eligibility_form' => 'required|boolean',
            'physical_form' => 'required|boolean',
            'blanket_waiver_form' => 'required|boolean',
            'ghsa_concussion_form' => 'required|boolean',
            'ghsa_cardiac_form' => 'required|boolean',
            'exam_date' => 'required|date',
            'restrictions' => 'string|nullable',
            'notes' => 'string|nullable',
        ]);

        $physical = Physical::create($physical)->load('athlete');

        return response()->json($physical, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Physical $physical
     * @return \Illuminate\Http\Response
     */
    public function show(Physical $physical)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Physical $physical
     * @return JsonResponse
     */
    public function update(Request $request, Physical $physical)
    {
        request()->validate([
            'athlete_id'                => 'integer',
            'history_form'              => 'boolean',
            'physical_exam_form'        => 'boolean',
            'medical_eligibility_form'  => 'boolean',
            'physical_form'             => 'boolean',
            'blanket_waiver_form'       => 'boolean',
            'ghsa_concussion_form'      => 'boolean',
            'ghsa_cardiac_form'         => 'boolean',
            'exam_date'                 => 'date',
            'restrictions'              => 'string|nullable',
            'notes'                     => 'string|nullable',
        ]);

        $physical->update(request([
            'athlete_id',
            'history_form',
            'physical_exam_form',
            'medical_eligibility_form',
            'physical_form',
            'blanket_waiver_form',
            'ghsa_concussion_form',
            'ghsa_cardiac_form',
            'exam_date',
            'restrictions',
            'notes'
        ]));

        return response()->json($physical, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Physical $physical
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Physical $physical)
    {
        $physical->delete();

        return response()->json(null, 204);
    }
}
