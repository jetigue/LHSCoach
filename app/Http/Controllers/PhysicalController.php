<?php

namespace App\Http\Controllers;

use App\Models\Physical;
use Carbon\Carbon;

class PhysicalController extends Controller {

    public function index()
    {
        $ly = Carbon::now()->year - 1;

        $physicals = Physical::with('athlete')
            ->orderBy('exam_date', 'desc')
            ->whereYear('exam_date', '>=', $ly)
            ->get();

        return view('physicals.index', compact('physicals'));
    }
}
