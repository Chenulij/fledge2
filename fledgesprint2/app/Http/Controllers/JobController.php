<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::query();

        // Apply filters
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        if ($request->filled('working_hours')) {
            $query->where('working_hours', $request->working_hours);
        }

        if ($request->filled('location')) {
            // Handle both "colombo X" and "remote" locations
            if ($request->location === 'remote') {
                $query->where('location', 'remote');
            } else {
                $query->where('location', 'like', '%' . $request->location . '%');
            }
        }

        // Get paginated results (recommended for large datasets)
        $jobs = $query->latest()->get();

        // For AJAX requests, return just the job listings partial
        if ($request->ajax()) {
            return view('partials.job_listings', compact('jobs'))->render();
        }

        // For regular requests, return the full view
        return view('jobs', compact('jobs'));
    }
}
