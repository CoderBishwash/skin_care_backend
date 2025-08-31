<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Product;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // List all doctors
    public function index()
    {
        $doctors = Doctor::with('products')->get(); // eager load recommended products
        return view('backend.doctors.index', compact('doctors'));
    }

    // Show create form
    public function create()
    {
        $products = Product::all(); // fetch all products for selection
        return view('backend.doctors.create', compact('products'));
    }

    // Store new doctor
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:doctors,email',
            'phone' => 'nullable|string',
            'specialization' => 'nullable|string',
            'recommended_products' => 'nullable|array',
        ]);

        $doctor = Doctor::create($data);

        // Attach selected recommended products
        if (!empty($data['recommended_products'])) {
            $doctor->products()->attach($data['recommended_products']);
        }

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor created successfully!');
    }

    // Show edit form
    public function edit(Doctor $doctor)
    {
        $products = Product::all();
        $doctor->load('products'); // load recommended products
        return view('backend.doctors.edit', compact('doctor', 'products'));
    }

    // Update doctor
    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:doctors,email,'.$doctor->id,
            'phone' => 'nullable|string',
            'specialization' => 'nullable|string',
            'recommended_products' => 'nullable|array',
        ]);

        $doctor->update($data);

        // Sync recommended products
        $doctor->products()->sync($data['recommended_products'] ?? []);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully!');
    }

    // Delete doctor
    public function destroy(Doctor $doctor)
    {
        $doctor->delete(); // this will also remove entries in pivot table if foreign keys have cascade delete
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully!');
    }
}
