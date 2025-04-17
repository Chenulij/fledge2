<?php
// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class LoginController extends Controller
// {
//     // Show the login form
//     public function showLoginForm()
//     {
//         return view('auth.login');
//     }

//     // Handle the login request
//     public function login(Request $request)
//     {
//         $credentials = $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',
//         ]);

//         if (Auth::attempt($credentials)) {
//             $request->session()->regenerate();
//             return redirect()->intended('/'); // Redirect to the profile page
//         }

//         return back()->withErrors([
//             'email' => 'The provided credentials do not match our records.',
//         ]);
//     }

//     // Handle the logout request
//     public function logout(Request $request)
//     {
//         Auth::logout(); // Log the user out
//         $request->session()->invalidate(); // Invalidate the session
//         $request->session()->regenerateToken(); // Regenerate the CSRF token
//         return redirect('/'); // Redirect to the home page
//     }
// }

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login'); // Same login page for both roles
    }

    // Handle the login request
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Check the role of the authenticated user
            if (Auth::user()->role === 'employer') {
                return redirect()->route('employer.dashboard'); // Redirect to employer dashboard
            }

            // Redirect regular users (students) to their home or profile page
            return redirect()->intended('/'); // Or any other page for students
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle the logout request
    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token
        return redirect('/'); // Redirect to the home page
    }
}

