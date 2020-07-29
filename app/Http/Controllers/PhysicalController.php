<?php

namespace App\Http\Controllers;

use App\Models\Physical;

class PhysicalController extends Controller {

    public function index()
    {
        $physicals = Physical::query()->orderBy('exam_date')->get();

        return view('physicals.index', compact('physicals'));
    }
}