<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // GET /products
    public function index(): JsonResponse
    {
        return response()->json(Products::orderBy('created_at', 'desc')->get());
    }

    // GET /products/{product}
    public function show(Products $product): JsonResponse
    {
        return response()->json($product);
    }

    // POST /products
    public function store(ProductRequest $request)
    {
        $product = Products::create($request->validated());

        if ($request->wantsJson()) {
            return response()->json($product, 201);
        }

        return redirect()->route('dashboard.products')
            ->with('success', 'Product created successfully!');
    }

    // PUT/PATCH /products/{product}
    public function update(ProductRequest $request, Products $product)
    {
        $product->update($request->validated());

        if ($request->wantsJson()) {
            return response()->json($product);
        }

        return redirect()->route('dashboard.products')
            ->with('success', 'Product updated successfully!');
    }

    // DELETE /products/{product}
    public function destroy(Products $product)
    {
        $product->delete();

        if (request()->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('dashboard.products')
            ->with('success', 'Product deleted successfully!');
    }

    public function dashboardIndex()
    {
        $products = Products::orderBy('created_at', 'desc')->get();
        return view('dashboard.products', compact('products'));
    }
}
