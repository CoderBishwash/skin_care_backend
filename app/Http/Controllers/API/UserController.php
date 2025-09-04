<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display the authenticated user's profile.
     */
    public function show(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'user' => $request->user()
        ]);
    }

    /**
     * Update the authenticated user's profile.
     */
    public function update(Request $request)
    {
        Log::info($request);
        $user = $request->user();

        // Validate input
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'age' => 'nullable|integer|min:0',
            'gender' => 'nullable|in:male,female,other',
            'password' => 'nullable|string|min:6|confirmed', // optional password change
        ]);

        // Update fields
        $user->username = $request->username;
        $user->email = $request->email;
        $user->age = $request->age ?? $user->age;
        $user->gender = $request->gender ?? $user->gender;

        // Optional password update
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // If email changed, reset verification and send notification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'user' => $user
        ]);
    }
}
