<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class ProductController extends Controller
{
    /**
     * List all products with recommended doctors
     */
    public function index()
    {
        $products = Product::with('recommendedByDoctors:id,name,specialization')->get();
        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    /**
     * Get a single product by ID with recommended doctors
     */
    public function show($id)
    {
        $product = Product::with('recommendedByDoctors:id,name,specialization')->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

}
