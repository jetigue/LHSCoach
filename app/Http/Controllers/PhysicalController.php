<?php

namespace App\Http\Controllers;

use App\Models\Physical;

class PhysicalController extends Controller {

    public function index()
    {
        $physicals = Physical::with('athlete')
            ->orderBy('exam_date', 'desc')
            ->get();

        return view('physicals.index', compact('physicals'));
    }
}
