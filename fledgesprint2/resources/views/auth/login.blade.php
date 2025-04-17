<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Log In</title>
    @vite(['resources/css/app.css', 'resources/js/login.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-purple-50 to-white min-h-screen font-['Inter']">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm p-4 flex max-w mx-auto px-4 sm:px-6 lg:px-8">
        <img src="{{ asset('images/logo.png') }}" alt="Fledge Logo" class="h-10 hover:scale-105 transition-transform duration-200">
    </nav>

    <!-- Centered Login Box -->
    <main class="flex-grow flex items-center justify-center p-6">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden w-full max-w-md">
            <!-- Decorative purple header -->
            <div class="bg-purple-900 py-6 px-8 text-center">
                <h2 class="text-2xl font-bold text-white">Welcome Back</h2>
                <p class="text-purple-200 mt-1">Login to access your account</p>
            </div>

            <!-- Form content -->
            <div class="p-8 sm:p-10">
                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <ul class="text-sm text-red-700 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="emailInput" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="emailInput" value="{{ old('email') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                            placeholder="your@email.com" required>
                    </div>
                    <div>
                        <label for="passwordInput" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" id="passwordInput"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                            placeholder="••••••••" required>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-purple-900 text-white py-3 px-4 rounded-lg font-medium hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200">
                            Sign In
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center text-sm">
                    <p class="text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="font-medium text-purple-900 hover:text-purple-700 hover:underline transition duration-200">
                            Sign up
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
