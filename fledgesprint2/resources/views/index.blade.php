<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fledge - Job Search</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
@include("components.navbar")
    <!-- Hero Section -->
    <header
    class="text-center py-12 md:py-16 bg-cover bg-center bg-no-repeat relative h-[250px] sm:h-[300px] md:h-[400px] w-full flex items-center justify-center"
    style="background-image: url('{{ asset('images/bg.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 px-4 w-full max-w-xl mx-auto">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white">Explore Opportunities</h1>
            <p class="text-white mt-2 md:mt-4 text-xs sm:text-sm md:text-base">Find the perfect part-time job that fits
                your academic schedule.</p>
        </div>
    </header>

    <!-- Job Listings -->
    <section class="max-w-4xl mx-auto mt-6 md:mt-8 px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl md:text-2xl font-semibold text-gray-800">Latest Job Listings</h2>
            <a href="{{ route('jobs.index') }}" class="flex items-center text-purple-900 hover:text-purple-700 text-sm md:text-base font-medium transition-colors">
                View All Jobs<i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <div class="grid gap-4 md:gap-6">
            @foreach($latestJobs as $job)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="p-5 md:p-6">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                        <!-- Left side - Job details -->
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">
                                    {{ ucfirst($job->category) }}
                                </span>
                                <span class="text-gray-500 text-sm">
                                    @if($job->job_type === 'in-office')
                                    <i class="fas fa-building mr-1"></i> On-site
                                    @else
                                    <i class="fas fa-laptop-house mr-1"></i> Remote
                                    @endif
                                </span>
                            </div>

                            <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2">{{ $job->title }}</h3>

                            <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600">
                                <span class="flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2 text-purple-500"></i>
                                    {{ ucfirst(str_replace('_', ' ', $job->location)) }}
                                </span>
                                <span class="flex items-center">
                                    <i class="far fa-clock mr-2 text-purple-500"></i>
                                    {{ ucfirst($job->working_hours) }} shift
                                </span>
                            </div>
                        </div>

                        <!-- Right side - Apply button -->
                        <div class="md:text-right">
                            <button class="bg-purple-900 hover:bg-purple-800 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Apply Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @if($latestJobs->isEmpty())
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <p class="text-gray-600">No job listings available at the moment.</p>
                <a href="{{ route('jobs.index') }}" class="inline-block mt-3 text-purple-900 hover:text-purple-700 font-medium">
                    Browse all opportunities
                </a>
            </div>
            @endif
        </div>
    </section>

    @include("components.footer")
</body>
</html>
