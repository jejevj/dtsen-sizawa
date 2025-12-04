<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Manually validate the request
        $request->validate([
            'user_id' => 'required',
            'password' => 'required',  // Adjust password length as needed
        ]);
        $credentials = $request->only('user_id', 'password');
        $hashedPassword = md5($credentials['password']);
        $user = User::where('user_id', $credentials['user_id'])->first();

        if ($user && $user->user_password === $hashedPassword) {
            Auth::login($user);

            if ($request->ajax()) {
                return response()->json(['success' => true, 'redirect_to' => route('dashboard')]);
            }
return redirect()->route('dashboard')->with('need_login', true);
        }

        if ($request->ajax()) {
            return response()->json(['error' => 'Kredensial tidak sesuai'], 422);
        }

        return back()->withErrors([
            'email' => 'Pengguna tidak ditemukan.',
        ]);
    }
}
