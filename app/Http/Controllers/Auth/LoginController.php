<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if ($user) {
            // Check MD5 first
            if (md5($credentials['password']) === $user->password) {
                // Optional: Upgrade to bcrypt
                $user->password = bcrypt($credentials['password']);
                $user->save();
                Auth::login($user);
                return redirect()->intended('dashboard');
            }

            // Fallback to bcrypt check
            if (Hash::check($credentials['password'], $user->password)) {
                Auth::login($user);
                return redirect()->intended('dashboard');
            }
        }

        return back()->withErrors([
            'username' => 'Invalid credentials',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function username()
    {
        return 'username';
    }
}
