<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Doctor;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::with('recommendedByDoctors')->latest()->get();
        return view('backend.products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        $doctors = Doctor::all();
        return view('backend.products.create', compact('doctors'));
    }

    // Store new product
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'expected_results' => 'nullable|string',
            'usage_instructions' => 'nullable|string',
            'time_of_use' => 'nullable|string',
            'shelf_life' => 'nullable|string',
            'incompatible_products' => 'nullable|string',
            'recommended_for' => 'nullable|string',
            'recommended_by' => 'nullable|array',
            'recommended_by.*' => 'exists:doctors,id',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Image upload to public/image/product
     // Image upload to public/image/product
if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageName = $image->getClientOriginalName(); // Keep the original name
    $image->move(public_path('image/product'), $imageName);
    $data['image'] = 'image/product/' . $imageName;
} else {
    $data['image'] = null;
}


        $product = Product::create($data);

        if (!empty($data['recommended_by'])) {
            $product->recommendedByDoctors()->sync($data['recommended_by']);
        }

        return redirect()->route('admin.products.index')->with('success', '✅ Product created successfully!');
    }

    // Show edit form
    public function edit(Product $product)
    {
        $doctors = Doctor::all();
        return view('backend.products.edit', compact('product', 'doctors'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'expected_results' => 'nullable|string',
            'usage_instructions' => 'nullable|string', 
            'time_of_use' => 'nullable|string',
            'shelf_life' => 'nullable|string',
            'incompatible_products' => 'nullable|string',
            'recommended_for' => 'nullable|string',
            'recommended_by' => 'nullable|array',
            'recommended_by.*' => 'exists:doctors,id',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
    // Delete old image if exists
    if ($product->image && file_exists(public_path($product->image))) {
        unlink(public_path($product->image));
    }

    $image = $request->file('image');
    $imageName = $image->getClientOriginalName(); // Keep original name
    $image->move(public_path('image/product'), $imageName);
    $data['image'] = 'image/product/' . $imageName;
} else {
    $data['image'] = $product->image; // keep old image if not updated
}


        $product->update($data);
        $product->recommendedByDoctors()->sync($data['recommended_by'] ?? []);

        return redirect()->route('admin.products.index')->with('success', '✅ Product updated successfully!');
    }

    // Delete product
    public function destroy(Product $product)
{
    // Check if the product has an image and if it exists in the folder
    if ($product->image && file_exists(public_path($product->image))) {
        unlink(public_path($product->image)); // Delete the image file
    }

    // Detach recommended doctors (many-to-many relation)
    $product->recommendedByDoctors()->detach();

    // Delete the product from the database
    $product->delete();

    return redirect()->route('admin.products.index')->with('success', '🗑️ Product and its image deleted successfully!');
}

}
