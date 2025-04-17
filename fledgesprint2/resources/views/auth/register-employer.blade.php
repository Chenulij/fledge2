<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Employer Sign Up</title>
    @vite(['resources/css/app.css', 'resources/js/register.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-purple-50 to-white min-h-screen font-['Inter']">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm p-4 flex max-w mx-auto px-4 sm:px-6 lg:px-8">
        <img src="{{ asset('images/logo.png') }}" alt="Fledge Logo" class="h-10 hover:scale-105 transition-transform duration-200">
    </nav>

    <!-- Centered Registration Box -->
    <main class="flex-grow flex items-center justify-center p-6">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden w-full max-w-lg">
            <!-- Decorative purple header -->
            <div class="bg-purple-900 py-6 px-8 text-center">
                <h2 class="text-xl font-bold text-white">Partner With Us</h2>
                <h3 class="text-2xl font-bold text-white mt-1">Create Employer Account</h3>
            </div>

            <!-- Form content -->
            <div class="p-8 sm:p-10">
                <!-- Validation errors -->
                <div id="validation-errors" class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded hidden">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <ul id="error-list" class="text-sm text-red-700 space-y-1"></ul>
                        </div>
                    </div>
                </div>

                <form id="employer-register-form" action="{{ route('employer.register') }}" method="POST" class="space-y-4">
                    @csrf
                    <!-- Company Name -->
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                        <input type="text" name="company_name" id="company_name"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                            placeholder="Example Pvt Ltd" required>
                        <div class="text-red-500 text-xs mt-1 error-message" id="company_name-error"></div>
                    </div>


                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Company Email</label>
                        <input type="email" name="email" id="email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                            placeholder="hr@example.com" required>
                        <div class="text-red-500 text-xs mt-1 error-message" id="email-error"></div>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="tel" name="phone" id="phone"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                            placeholder="07xxxxxxxx" required>
                        <div class="text-red-500 text-xs mt-1 error-message" id="phone-error"></div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                            placeholder="••••••••" required>
                        <div class="text-red-500 text-xs mt-1 error-message" id="password-error"></div>

                        <!-- Password Strength Indicator -->
                        <div class="mt-2">
                            <div class="flex justify-between mb-1">
                                <span class="text-xs text-gray-600">Password Strength:</span>
                                <span class="text-xs font-medium" id="password-strength-text">None</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5">
                                <div id="password-strength-bar" class="h-1.5 rounded-full transition-all duration-300" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                            placeholder="••••••••" required>
                        <div class="text-red-500 text-xs mt-1 error-message" id="password_confirmation-error"></div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="signup-button"
                        class="w-full bg-purple-900 text-white py-3 px-4 rounded-lg font-medium hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200 mt-2">
                        Register Company
                    </button>
                </form>

                <div class="mt-4 text-center text-sm">
                    <p class="text-gray-600">
                        Already registered?
                        <a href="{{ route('login') }}" class="font-medium text-purple-900 hover:text-purple-700 hover:underline transition duration-200">
                            Log in
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>


</body>

</html>