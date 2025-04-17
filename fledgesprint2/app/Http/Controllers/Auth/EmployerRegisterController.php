<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class EmployerRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register-employer');
    }



    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employers'],
            'phone' => ['required', 'digits:10'],
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols(), 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $employer = Employer::create([
                'company_name' => $request->company_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            Auth::guard('web')->login($employer); // If using default 'web' guard for employer

            return response()->json([
                'status' => 'success',
                'message' => 'Employer registered successfully!',
                'redirect' => url('/employer/dashboard'),
                'authenticated' => Auth::check()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error registering employer: ' . $e->getMessage()
            ], 500);
        }
    }
}
