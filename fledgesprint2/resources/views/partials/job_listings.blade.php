@forelse($jobs as $job)
<div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow"
     data-category="{{ $job->category }}"
     data-job-type="{{ $job->job_type }}"
     data-working-hours="{{ $job->working_hours }}"
     data-location="{{ $job->location }}">
    <div class="p-6">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-6">
            <!-- Left side - Job details -->
            <div class="flex-1">
                <div class="flex flex-wrap items-center gap-3 mb-4">
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
                    <span class="text-gray-500 text-sm">
                        <i class="far fa-clock mr-1"></i> {{ ucfirst($job->working_hours) }} shift
                    </span>
                </div>

                <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $job->title }}</h2>

                <div class="flex items-center text-gray-600 mb-4">
                    <i class="fas fa-map-marker-alt mr-2 text-purple-500"></i>
                    {{ ucfirst(str_replace('_', ' ', $job->location)) }}
                </div>

                @if($job->description)
                <p class="text-gray-600 mb-4">{{ $job->description }}</p>
                @endif
            </div>

            <!-- Right side - Apply button -->
            <div class="md:text-right flex-shrink-0">
                <button class="bg-purple-900 hover:bg-purple-800 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                    Apply Now
                </button>
            </div>
        </div>
    </div>
</div>
@empty
<div class="bg-white rounded-xl shadow-md p-8 text-center">
    <div class="text-purple-500 mb-4">
        <i class="fas fa-briefcase fa-3x"></i>
    </div>
    <h3 class="text-xl font-semibold text-gray-800 mb-2">No jobs found</h3>
    <p class="text-gray-600 mb-4">We couldn't find any jobs matching your criteria.</p>
    <button id="resetIcon" class="text-purple-900 hover:text-purple-700 font-medium">
        <i class="fas fa-undo mr-2"></i> Reset Filters
    </button>
</div>
@endforelse
