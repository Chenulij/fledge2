<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Auth\EmployerRegisterController;
use App\Http\Controllers\EmployerDashboardController;
use App\Http\Controllers\EmployerJobController;
use Illuminate\Support\Facades\Auth;

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Login routes for employers
Route::get('/employer/login', [LoginController::class, 'showEmployerLoginForm'])->name('employer.login');
Route::post('/employer/login', [LoginController::class, 'employerLogin']); // Handle employer login


// Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

Route::get('/register-employer', [EmployerRegisterController::class, 'showRegistrationForm'])->name('register-employer');
Route::post('/register-employer', [EmployerRegisterController::class, 'register'])->name('employer.register');

// Real-time field validation route
Route::post('/validate-field', [RegisterController::class, 'validateField'])->name('validate.field');

// Home page showing latest jobs
Route::get('/', function () {
    $latestJobs = \App\Models\Job::latest()->take(2)->get();
    return view('index', ['latestJobs' => $latestJobs]);
});

// Job listings page
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');

// Profile page (requires authentication)
Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Employer Dashboard routes
// Route::middleware(['auth'])->prefix('employer')->name('employer.')->group(function () {
//     Route::get('/dashboard', [EmployerDashboardController::class, 'dashboard'])->name('dashboard');

//     // Job routes
//     Route::get('/create-job', [EmployerJobController::class, 'create'])->name('create-job');
//     Route::post('/store-job', [EmployerJobController::class, 'store'])->name('store-job');
//     Route::get('/jobs/{id}/edit', [EmployerJobController::class, 'edit'])->name('jobs.edit');
//     Route::put('/jobs/{id}', [EmployerJobController::class, 'update'])->name('jobs.update');
//     Route::delete('/jobs/{id}', [EmployerJobController::class, 'destroy'])->name('jobs.destroy');
//     Route::post('/jobs/{id}/complete', [EmployerJobController::class, 'complete'])->name('jobs.complete');
// });

// For testing employer auto login (remove after testing)
Route::get('/autologinemployer', function () {
    $user = \App\Models\User::where('role', 'employer')->first();

    if ($user) {
        Auth::login($user);
        return redirect('/employer/dashboard');
    } else {
        return "No employer user found in the database.";
    }
});


Route::middleware(['auth'])->prefix('employer')->name('employer.')->group(function () {
    Route::get('/dashboard', [EmployerDashboardController::class, 'dashboard'])->name('dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/employer/create-job', [EmployerJobController::class, 'create'])->name('employer.job.create');
});


Route::middleware(['auth'])->group(function () {
    Route::post('/employer/create-job', [EmployerJobController::class, 'store'])->name('employer.store-job');
});