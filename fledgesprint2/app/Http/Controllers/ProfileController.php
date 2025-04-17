<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;

class ProfileController extends Controller
{

    public function show()
    {
        $student = Auth::user(); // Fetch logged-in student data
        return view('profile', compact('student'));
    }

    public function update(Request $request)
    {
        $student = Auth::user(); // Get logged-in student

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students,email,' . $student->id,
            'phone' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cv' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($student->profile_picture) {
                Storage::disk('public')->delete($student->profile_picture);
            }
            $student->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        if ($request->hasFile('cv')) {
            if ($student->cv) {
                Storage::disk('public')->delete($student->cv);
            }
            $student->cv = $request->file('cv')->store('cvs', 'public');
        }

        // Manually set the values and save
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save(); // Save the student

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
