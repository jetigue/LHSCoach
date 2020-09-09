<?php

namespace App\Http\Controllers;

use App\Models\Physical;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PhysicalController extends Controller {

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $ly = Carbon::now()->year - 1;

        $physicals = Physical::with(['athlete' => function ($q) {
            $q->orderBy('last_name')->orderBy('first_name');
        }])
            ->whereYear('exam_date', '>=', $ly)
            ->paginate(50);

        return view('physicals.index', compact('physicals'));
    }

    /**
     * @param Physical $physical
     * @return mixed
     */
    public function show(Physical $physical)
    {
         return Storage::disk('public')->download($physical->form_path);
    }
}
