<nav class="bg-white shadow-lg px-4 py-3 md:px-4 md:py-4">
    <div class="mx-auto flex justify-between items-center gap-4">
        <!-- Mobile menu button (hidden on desktop) -->
        <button id="mobile-menu-button" class="sm:hidden text-gray-700 focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <!-- Logo with hover effects -->
        <a href="/" class="transform transition-all duration-300 hover:scale-110">
            <img src="{{ asset('images/logo.png') }}" alt="Fledge Logo" class="h-10 md:h-12 hover:brightness-110">
        </a>

        <!-- Navigation Links -->
        <div class="flex items-center space-x-2 sm:space-x-3 md:space-x-4">
            <!-- Main Links (hidden on mobile) -->
            <div class="hidden sm:flex space-x-3">
                <a href="/" class="nav-link hover:scale-105 hover:text-purple-800 hover:bg-purple-50">
                    <i class="fas fa-home mr-1"></i> Home
                </a>
                <a href="/jobs" class="nav-link hover:scale-105 hover:text-purple-800 hover:bg-purple-50">
                    <i class="fas fa-briefcase mr-1"></i> Jobs
                </a>
            </div>

            <!-- Authentication Section -->
            <div class="border-l border-gray-200 pl-3 md:pl-4 flex items-center space-x-2 md:space-x-3">
                @auth
                <!-- Profile Dropdown with Visible Logout -->
                <div x-data="{ open: false }" class="relative flex items-center space-x-3">
                    <!-- Standalone Logout Button -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn transform hover:scale-105 hover:bg-purple-800 hover:text-white hover:shadow-lg">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </button>
                    </form>

                    <!-- Profile Picture -->
                    <button @click="open = !open" class="flex items-center space-x-1 focus:outline-none group">
                        <div class="w-8 h-8 md:w-9 md:h-9 rounded-full overflow-hidden border-2 border-purple-100 group-hover:border-purple-400 transition-all duration-300 transform group-hover:scale-110">
                            @if(Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 group-hover:brightness-110">
                            @else
                            <div class="w-full h-full bg-gradient-to-br from-purple-900 to-purple-600 flex items-center justify-center text-white group-hover:from-purple-800 group-hover:to-purple-500">
                                <i class="fas fa-user text-sm md:text-lg group-hover:scale-110 transition-transform duration-300"></i>
                            </div>
                            @endif
                        </div>
                        <span class="hidden md:inline text-gray-700 text-sm group-hover:text-purple-800 transition-colors duration-300">{{ Auth::user()->first_name }}</span>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 top-full mt-2 w-44 bg-white rounded-md shadow-lg py-1 z-50">
                        <a href="{{ route('profile') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-purple-100 hover:text-purple-900 transform hover:scale-[1.02] transition-all duration-200">
                            <i class="fas fa-user-circle mr-2 text-purple-700"></i> My Profile
                        </a>
                    </div>
                </div>
                @else
                <!-- Guest Links (icons removed for mobile) -->
                <a href="{{ route('login') }}" class="auth-btn text-sm px-3 py-1.5 transform hover:scale-105 hover:from-purple-800 hover:to-purple-600 hover:shadow-lg">
                    <span class="sm:hidden">Sign In</span>
                    <span class="hidden sm:inline"><i class="fas fa-sign-in-alt mr-1"></i> Sign In</span>
                </a>
                <!-- <a href="{{ route('register') }}" class="auth-btn bg-gradient-to-r text-white from-purple-900 to-purple-700 hover:from-purple-800 hover:to-purple-600 text-sm px-3 py-1.5 transform hover:scale-105 hover:shadow-lg">
                    <span class="sm:hidden">Register</span>
                    <span class="hidden sm:inline"><i class="fas fa-user-plus mr-1"></i> Register</span>
                </a> -->
                @endauth
            </div>

            <!-- Register Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="auth-btn bg-gradient-to-r text-white from-purple-900 to-purple-700 hover:from-purple-800 hover:to-purple-600 text-sm px-3 py-1.5 transform hover:scale-105 hover:shadow-lg flex items-center space-x-1">
                    <span><i class="fas fa-user-plus mr-1"></i> Register</span>
                    <i class="fas fa-caret-down text-xs"></i>
                </button>
                <div x-show="open" @click.away="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg z-50">
                    <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-800">
                        <i class="fas fa-user-graduate mr-2"></i> As a Student
                    </a>
                    <a href="{{ route('register-employer') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-800">
                        <i class="fas fa-building mr-2"></i> As an Employer
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Sidebar Navigation -->
<div id="mobile-sidebar" class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl z-50 transform -translate-x-full transition-transform duration-300 ease-in-out sm:hidden">
    <div class="flex items-center justify-between px-4 py-5 border-b border-gray-200">
        <a href="/" class="transform transition-all duration-300 hover:scale-110">
            <img src="{{ asset('images/logo.png') }}" alt="Fledge Logo" class="h-10 hover:brightness-110">
        </a>
        <button id="close-mobile-menu" class="text-gray-500 hover:text-gray-700 focus:outline-none">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>
    <div class="px-4 py-6">
        <div class="space-y-4">
            <a href="/" class="block px-4 py-3 text-lg font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-800 transition-all duration-300">
                <i class="fas fa-home mr-3"></i> Home
            </a>
            <a href="/jobs" class="block px-4 py-3 text-lg font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-800 transition-all duration-300">
                <i class="fas fa-briefcase mr-3"></i> Jobs
            </a>
            @auth
            <a href="{{ route('profile') }}" class="block px-4 py-3 text-lg font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-800 transition-all duration-300">
                <i class="fas fa-user-circle mr-3"></i> My Profile
            </a>
            <form action="{{ route('logout') }}" method="POST" class="block w-full">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-3 text-lg font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-800 transition-all duration-300">
                    <i class="fas fa-sign-out-alt mr-3"></i> Logout
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="block px-4 py-3 text-lg font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-800 transition-all duration-300">
                <i class="fas fa-sign-in-alt mr-3"></i> Sign In
            </a>
            <a href="{{ route('register') }}" class="block px-4 py-3 text-lg font-medium text-purple-700 rounded-lg bg-purple-50 hover:bg-purple-100 transition-all duration-300">
                <i class="fas fa-user-plus mr-3"></i> Register
            </a>
            @endauth
        </div>
    </div>
</div>
<div id="mobile-sidebar-backdrop" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden sm:hidden"></div>



<style>
    .nav-link {
        @apply px-3 py-1.5 text-sm font-medium text-gray-700 rounded-lg transition-all duration-300 flex items-center;
    }

    .auth-btn {
        @apply bg-gradient-to-r from-purple-900 to-purple-700 text-sm font-medium text-white rounded-lg transition-all duration-300 shadow hover:shadow-md;
    }

    .logout-btn {
        @apply px-3 py-1 text-sm font-medium text-purple-900 rounded-lg transition-all duration-300 border-2 border-purple-900 hover:border-purple-800;
    }
</style>

<!-- AlpineJS for dropdown functionality -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<!-- Mobile menu toggle script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const closeMobileMenu = document.getElementById('close-mobile-menu');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const mobileSidebarBackdrop = document.getElementById('mobile-sidebar-backdrop');

        mobileMenuButton.addEventListener('click', function() {
            mobileSidebar.classList.remove('-translate-x-full');
            mobileSidebarBackdrop.classList.remove('hidden');
        });

        closeMobileMenu.addEventListener('click', function() {
            mobileSidebar.classList.add('-translate-x-full');
            mobileSidebarBackdrop.classList.add('hidden');
        });

        mobileSidebarBackdrop.addEventListener('click', function() {
            mobileSidebar.classList.add('-translate-x-full');
            mobileSidebarBackdrop.classList.add('hidden');
        });
    });
</script>