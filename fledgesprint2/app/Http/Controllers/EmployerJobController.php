<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class EmployerJobController extends Controller
{
    // Show the job creation form
    public function create()
    {
        return view('employer.create-job');
    }

    // Store the new job
    public function store(Request $request)
    {
        // Validate the input fields
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'job_type' => 'required|string',
            'working_hours' => 'required|string',
            'location' => 'required|string',
            'pay_rate' => 'required|numeric', // Use numeric instead of string
            'description' => 'nullable|string',
        ]);

        // Add the employer_id manually to the validated data
        $validated['employer_id'] = auth()->id(); // Save the employer ID

        // Create the job record
        Job::create($validated);

        return redirect()->route('employer.dashboard')->with('success', 'Job posted successfully!');
    }

    // Show the job edit form
    public function edit(Job $job)
    {
        return view('employer.edit-job', compact('job'));
    }

    // Update the job
    public function update(Request $request, Job $job)
    {
        // Validate the input fields
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'job_type' => 'required|string',
            'working_hours' => 'required|string',
            'location' => 'required|string',
            'pay_rate' => 'required|numeric', // Use numeric instead of string
            'description' => 'nullable|string',
        ]);

        // Update the job record with the validated data
        $job->update($validated);

        return redirect()->route('employer.dashboard')->with('success', 'Job updated successfully!');
    }

    // Delete the job
    public function destroy(Job $job)
    {
        // Delete the job
        $job->delete();

        return redirect()->route('employer.dashboard')->with('success', 'Job deleted successfully!');
    }

    // Mark the job as completed
    public function complete(Job $job)
    {
        // Update the status to completed
        $job->update(['status' => 'completed']);

        return redirect()->route('employer.dashboard')->with('success', 'Job marked as completed!');
    }
}
