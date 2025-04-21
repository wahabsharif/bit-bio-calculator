<?php

namespace App\Http\Controllers;

use App\Models\CellType;
use Illuminate\Http\Request;

class CellTypeController extends Controller
{
    public function index()
    {
        $cellTypes = CellType::all();
        return response()->json($cellTypes);
    }

    public function show($id)
    {
        $cellType = CellType::find($id);

        if (!$cellType) {
            return response()->json(['message' => 'Cell type not found'], 404);
        }

        return response()->json($cellType);
    }
}
