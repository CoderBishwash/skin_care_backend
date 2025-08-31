<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Show the admin login form
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle the login request
     */
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Hardcoded admin credentials
        $adminEmail = 'aashika@gmail.com';
        $adminPassword = '123456789';

        // Check if input matches the hardcoded admin credentials
        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            
            // Store session keys
            // This is what allows middleware to check if admin is logged in
            session([
                'admin_logged_in' => true,    // Boolean: true if admin logged in
                'admin_email' => $adminEmail  // Optional: store admin email
            ]);

            // Redirect to the admin dashboard
            return redirect()->route('admin.dashboard');
        }

        // If credentials are incorrect, redirect back with an error
        return back()->withErrors([
            'email' => 'Invalid credentials. Only admin can login.'
        ])->withInput();
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        // Remove session keys to log out the admin
        $request->session()->forget(['admin_logged_in', 'admin_email']);

        // Redirect to login page
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
