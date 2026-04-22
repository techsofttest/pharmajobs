<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        // Check which guard to use based on the user's role
        $profile = Profile::where('email', $request->email)->first();

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'The provided credentials do not match our records.',
            ], 401);
        }

        $guard = ($profile->role === 'employer') ? 'employer' : 'employee';

        if (Auth::guard($guard)->attempt($credentials, $remember)) {
            $user = Auth::guard($guard)->user();

            if (!$user->is_active) {
                Auth::guard($guard)->logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Your account is currently inactive. Please contact support.',
                ], 403);
            }

            // Determine redirect route based on role
            $redirect = session()->pull('intended_url');
            
            if (!$redirect) {
                $redirect = ($user->role === 'employer') 
                    ? route('employer.dashboard') 
                    : route('employee.dashboard');
            }

            return response()->json([
                'success' => true,
                'redirect' => $redirect,
                'message' => 'Login successful. Redirecting...',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'The provided credentials do not match our records.',
        ], 401);
    }

    public function logout(Request $request)
    {
        // Logout from both potential guards
        Auth::guard('employee')->logout();
        Auth::guard('employer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
