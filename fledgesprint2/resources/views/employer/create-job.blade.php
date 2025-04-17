<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job - Fledge</title>
    @vite('resources/js/jobs.js')
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto px-4 py-10">
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-purple-900 mb-6">Post a New Job</h2>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('employer.store-job') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                    <input type="text" name="title" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <input type="text" name="category" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Job Type</label>
                    <select name="job_type" class="w-full p-2 border border-gray-300 rounded-lg" required>
                        <option value="in-office">In Office</option>
                        <option value="remote">Remote</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Working Hours</label>
                    <select name="working_hours" class="w-full p-2 border border-gray-300 rounded-lg" required>
                        <option value="morning">Morning</option>
                        <option value="evening">Evening</option>
                        <option value="night">Night</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" name="location" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pay Rate</label>
                    <input type="text" name="pay_rate" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="4" class="w-full p-2 border border-gray-300 rounded-lg"></textarea>
                </div>

                <button type="submit" class="bg-purple-900 text-white px-6 py-2 rounded-lg hover:bg-purple-800 transition">
                    Post Job
                </button>
            </form>
        </div>
    </div>

    @include('components.footer')
</body>
</html>
