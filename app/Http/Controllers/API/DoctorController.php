<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Get all doctors
     */
    public function index()
    {
        $doctors = Doctor::all(); // fetch all doctors

        return response()->json([
            'success' => true,
            'data' => $doctors
        ]);
    }

    /**
     * Get a single doctor with recommended products
     */
    public function show($id)
    {
        $doctor = Doctor::with('products:id,name,slug,description,image')->find($id);

        if (!$doctor) {
            return response()->json([
                'success' => false,
                'message' => 'Doctor not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $doctor
        ]);
    }
    /**
 * Get all products recommended by a specific doctor
 */
public function productsByDoctor($id)
{
    $doctor = Doctor::with('products')->find($id);

    if (!$doctor) {
        return response()->json([
            'success' => false,
            'message' => 'Doctor not found'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $doctor->products
    ]);
}

}
