<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Manually validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',  // Adjust password length as needed
        ]);

        $credentials = $request->only('email', 'password');

        // Hash the input password using MD5
        $hashedPassword = md5($credentials['password']);

        // Attempt to authenticate the user by checking email and MD5 hashed password
        $user = User::where('email', $credentials['email'])->first();

        if ($user && $user->user_password === $hashedPassword) {
            // Manually authenticate the user
            Auth::login($user);

            // If the request is AJAX, return success response with redirect URL
            if ($request->ajax()) {
                return response()->json(['success' => true, 'redirect_to' => route('dashboard')]);
            }

            // If not an AJAX request, redirect to the intended page
            return redirect()->intended('/dashboard');
        }

        // If authentication fails
        if ($request->ajax()) {
            return response()->json(['error' => 'Invalid credentials'], 422);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
