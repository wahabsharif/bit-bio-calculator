<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $Products = Products::all();
        return response()->json($Products);
    }

    public function show($id)
    {
        $Products = Products::find($id);

        if (!$Products) {
            return response()->json(['message' => 'Cell type not found'], 404);
        }

        return response()->json($Products);
    }
}
