<?php

namespace App\Http\Controllers\API;

use App\Models\Physical;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use PDF;

class PhysicalFormController extends Controller
{
    /**
     * @param Physical $physical
     * @return Application|ResponseFactory|Response
     */
    public function store(Physical $physical)
    {
        request()->validate([
            'physical-form' => 'required|file|max:12000',
        ]);

        $physical->update([
            'form_path' => request()->file('physical-form')->store('physicals', 'public'),
        ]);

        return response([], 204);
    }
}
