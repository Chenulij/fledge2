<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class EmployerDashboardController extends Controller
{

    public function dashboard()
    {
        $jobs = Job::with(['applications.student'])
            ->where('employer_id', auth()->id())
            ->latest()
            ->get();

        return view('employer.dashboard', compact('jobs'));
    }

    
}
