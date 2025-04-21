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
}
