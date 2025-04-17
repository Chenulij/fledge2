document.addEventListener('DOMContentLoaded', function () {
    // Job Filtering Functionality
    const searchButton = document.getElementById('searchButton');
    const resetButton = document.getElementById('resetButton');
    const jobListings = document.getElementById('jobListings');

    // Use event delegation for resetIcon since it's dynamically loaded
    document.addEventListener('click', function (e) {
        if (e.target && e.target.id === 'resetIcon') {
            resetFilters();
        }
    });

    if (searchButton) {
        searchButton.addEventListener('click', filterJobs);
    }

    if (resetButton) {
        resetButton.addEventListener('click', resetFilters);
    }

    function getFilterValues() {
        return {
            category: document.getElementById('category')?.value || '',
            jobType: document.getElementById('jobType')?.value || '',
            workingHours: document.getElementById('workingHours')?.value || '',
            location: document.getElementById('location')?.value || ''
        };
    }

    function filterJobs() {
        const { category, jobType, workingHours, location } = getFilterValues();

        // Show loading state
        jobListings.innerHTML = `
            <div class="bg-white rounded-xl shadow-md p-8 text-center">
                <div class="animate-pulse">
                    <div class="h-8 w-8 bg-purple-200 rounded-full mx-auto mb-4"></div>
                    <div class="h-4 bg-purple-200 rounded w-1/2 mx-auto mb-2"></div>
                    <div class="h-4 bg-purple-200 rounded w-3/4 mx-auto"></div>
                </div>
            </div>
        `;

        // Build query parameters
        const params = new URLSearchParams();
        if (category) params.append('category', category);
        if (jobType) params.append('job_type', jobType);
        if (workingHours) params.append('working_hours', workingHours);
        if (location) params.append('location', location);

        // Make AJAX request
        fetch(`/jobs?${params.toString()}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html',
            }
        })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.text();
            })
            .then(html => {
                jobListings.innerHTML = html;
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorState();
            });
    }

    function showErrorState() {
        jobListings.innerHTML = `
            <div class="bg-white rounded-xl shadow-md p-8 text-center">
                <div class="text-red-500 mb-4">
                    <i class="fas fa-exclamation-triangle fa-2x"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Error Loading Jobs</h3>
                <p class="text-gray-600 mb-4">Please try again later.</p>
                <button id="retryButton" class="text-purple-900 hover:text-purple-700 font-medium">
                    <i class="fas fa-sync-alt mr-2"></i> Retry
                </button>
            </div>
        `;

        // Add event listener to the dynamically created retry button
        document.getElementById('retryButton')?.addEventListener('click', filterJobs);
    }

    function resetFilters() {
        const category = document.getElementById('category');
        const jobType = document.getElementById('jobType');
        const workingHours = document.getElementById('workingHours');
        const location = document.getElementById('location');

        if (category) category.value = '';
        if (jobType) jobType.value = '';
        if (workingHours) workingHours.value = '';
        if (location) location.value = '';

        filterJobs(); // Refresh with empty filters
    }
});
