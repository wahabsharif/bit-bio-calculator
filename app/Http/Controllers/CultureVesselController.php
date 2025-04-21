<?php

namespace App\Http\Controllers;

use App\Models\CultureVessel;

class CultureVesselController extends Controller
{
    // Get all culture vessels
    public function index()
    {
        return response()->json(CultureVessel::all());
    }

    // Get a single culture vessel by ID
    public function show($id)
    {
        $vessel = CultureVessel::find($id);

        if (!$vessel) {
            return response()->json(['message' => 'Culture vessel not found'], 404);
        }

        return response()->json($vessel);
    }
}
