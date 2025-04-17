<!-- resources/views/employer/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Dashboard - Fledge</title>
    @vite('resources/js/jobs.js')
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto px-4 py-10">
        <h2 class="text-2xl font-bold text-purple-900 mb-6">My Posted Jobs</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @forelse($jobs as $job)
            <div class="p-4 bg-white shadow rounded mb-4">
                <h3 class="text-xl font-bold">{{ $job->title }}</h3>
                <p class="text-sm text-gray-600 mt-1">{{ $job->category }} | {{ $job->job_type }} | {{ $job->location }}</p>
                <p class="text-sm text-gray-600 mt-1">Pay Rate: {{ $job->pay_rate }}</p>
                <p class="mt-3 text-gray-800">{{ $job->description }}</p>

                <!-- Applications Section -->
                <div class="mt-4">
                    <h4 class="font-bold text-lg">Applications</h4>

                    @forelse($job->applications as $application)
                        <div class="mt-3 p-4 bg-gray-50 border rounded-md">
                            <p class="font-semibold">{{ $application->student->name }}</p>
                            <p class="text-sm text-gray-600">Applied on: {{ $application->created_at->toFormattedDateString() }}</p>
                            <a href="{{ route('employer.job.edit', $job->id) }}" class="text-blue-600 hover:underline mt-2 inline-block">View Application</a>
                            <!-- Add logic to mark job as "completed" -->
                            <form action="{{ route('employer.job.complete', $job->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-green-600 hover:underline">Mark as Completed</button>
                            </form>
                        </div>
                    @empty
                        <p>No applications yet.</p>
                    @endforelse
                </div>

                <!-- Edit/Delete Job Options -->
                <div class="mt-4 flex space-x-4">
                    <a href="{{ route('employer.job.edit', $job->id) }}" class="text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('employer.job.delete', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-700">No jobs posted yet. <a href="{{ route('employer.job.create') }}" class="text-purple-600 hover:underline">Post a job</a></p>
        @endforelse
    </div>

    @include('components.footer')
</body>

</html>
