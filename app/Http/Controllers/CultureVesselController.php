<?php

namespace App\Http\Controllers;

use App\Models\CultureVessel;
use Illuminate\Http\Request;

class CultureVesselController extends Controller
{
    // Get all culture vessels
    public function index(Request $request)
    {
        $vessels = CultureVessel::orderBy('updated_at', 'desc')->get();

        // return JSON if this is an AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($vessels);
        }

        return view('culture-vessels', compact('vessels'));
    }



    // Dashboard index method, ordered by updated_at desc
    public function dashboardIndex()
    {
        $vessels = CultureVessel::orderBy('updated_at', 'desc')->get();
        return view('dashboard.culture-vessels', compact('vessels'));
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

    // Store a new culture vessel
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plate_format' => 'required|string|max:50',
            'surface_area_cm2' => 'required|numeric|min:0',
            'media_volume_per_well_ml' => 'required|numeric|min:0',
        ]);

        CultureVessel::create($validated);

        return redirect()->route('dashboard.culture-vessels')
            ->with('success', 'Culture vessel created successfully!');
    }

    // Update the specified culture vessel
    public function update(Request $request, $id)
    {
        $vessel = CultureVessel::findOrFail($id);

        $validated = $request->validate([
            'plate_format' => 'required|string|max:50',
            'surface_area_cm2' => 'required|numeric|min:0',
            'media_volume_per_well_ml' => 'required|numeric|min:0',
        ]);

        $vessel->update($validated);

        // Check if request came from dashboard and redirect accordingly
        if (str_contains(url()->previous(), 'dashboard')) {
            return redirect()->route('dashboard.culture-vessels')
                ->with('success', 'Culture vessel updated successfully!');
        }

        return redirect()->route('culture-vessels.index')
            ->with('success', 'Culture vessel updated successfully!');
    }

    // Delete the specified culture vessel
    public function destroy($id)
    {
        $vessel = CultureVessel::findOrFail($id);
        $vessel->delete();

        return redirect()->route('dashboard.culture-vessels')
            ->with('success', 'Culture vessel deleted successfully!');
    }
}
