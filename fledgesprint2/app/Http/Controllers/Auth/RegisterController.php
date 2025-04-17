<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\AllowedStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    // Validation rules for registration
    $validator = Validator::make($request->all(), [
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:students'],
        'phone' => ['required', 'digits:10'],
        'student_id' => ['required', 'string', 'max:20'],
        'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols(), 'confirmed'],
    ]);

    // If validation fails, return error response
    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ], 422);
    }

    // Check if the student ID is already registered in the students table
    if (Student::where('student_id', $request->student_id)->exists()) {
        return response()->json([
            'status' => 'student-id-exists',
            'errors' => ['student_id' => ['This student ID is already registered.']]
        ], 422);
    }

    // Check if the student ID exists in the allowed_students table
    $allowedStudent = AllowedStudent::where('student_id', $request->student_id)->first();

    if (!$allowedStudent) {
        return response()->json([
            'status' => 'allow-error',
            'errors' => ['student_id' => ['This student ID is not recognized.']]
        ], 422);
    }

    // Ensure first name and last name match only when checking allowed_students
    if ($allowedStudent->first_name !== $request->first_name || $allowedStudent->last_name !== $request->last_name) {
        return response()->json([
            'status' => 'name-mismatch',
            'errors' => ['first_name' => ['The first name and last name do not match our records.']]
        ], 422);
    }

    // Create a new student record
    $student = Student::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'student_id' => $request->student_id,
        'password' => Hash::make($request->password),
    ]);

    // Update the allowed students table to mark the student as registered
    $allowedStudent->update(['is_registered' => true]);

    // Log the student in
    Auth::login($student);

    // Return success response with redirect URL
    return response()->json([
    'status' => 'success',
    'message' => 'Registration successful!',
    'redirect' => url('/'),
    'authenticated' => Auth::check() // Add this line
]);
}

}
