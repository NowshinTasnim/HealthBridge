<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /**
     * Display the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleRegistration(Request $request)
    {
        // Validate input with password length between 8 and 12 characters
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:12|confirmed',
        ]);

        // Insert data using a manual query with SHA-256 hashed password
        DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => hash('sha256', $request->input('password')), // SHA-256 hashing
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect to login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful!');
    }
}
