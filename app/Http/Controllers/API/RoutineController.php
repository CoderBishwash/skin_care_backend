<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class RoutineController extends Controller
{
    // List all products in user's routine
public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $products = $user->routineProducts()->with('recommendedByDoctors')->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);

    $user = Auth::user();
    if (!$user) return response()->json(['message' => 'User not authenticated'], 401);

    $productId = $request->product_id;

    if ($user->routineProducts()->where('product_id', $productId)->exists()) {
        return response()->json(['message' => 'Product already in routine'], 400);
    }

    $user->routineProducts()->attach($productId);

    return response()->json(['message' => 'Product added to routine successfully'], 200);
}


    // Remove product from routine
    public function destroy($productId)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        if (!$user->routineProducts()->where('product_id', $productId)->exists()) {
            return response()->json(['message' => 'Product not found in routine'], 404);
        }

        $user->routineProducts()->detach($productId);

        return response()->json(['message' => 'Product removed from routine']);
    }
}
