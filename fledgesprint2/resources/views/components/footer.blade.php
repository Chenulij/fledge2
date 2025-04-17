<!-- Footer -->
<footer class="bg-gradient-to-b from-purple-900 to-purple-800 text-white mt-12 py-8 px-4 md:py-10">
    <div class="max-w-7xl mx-auto">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 lg:gap-10">
            <!-- About Section -->
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Fledge Logo" class="h-8">
                </div>
                <p class="text-purple-200 text-sm leading-relaxed">
                    Connecting students with flexible part-time opportunities that complement their academic journey.
                </p>
                <div class="flex space-x-4 pt-2">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold tracking-wide">Quick Links</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="/jobs" class="footer-link">
                            <i class="fas fa-briefcase mr-2"></i> Browse Jobs
                        </a>
                    </li>
                    <li>
                        <a href="/post-job" class="footer-link">
                            <i class="fas fa-plus-circle mr-2"></i> Post a Job
                        </a>
                    </li>
                    <li>
                        <a href="/faq" class="footer-link">
                            <i class="fas fa-question-circle mr-2"></i> FAQs
                        </a>
                    </li>
                    <li>
                        <a href="/login" class="footer-link">
                            <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold tracking-wide">Contact Us</h3>
                <div class="space-y-3">
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-purple-300"></i>
                        <p class="text-purple-200 text-sm">
                            123 University Ave<br>
                            Colombo 03, Sri Lanka
                        </p>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-phone-alt mr-3 text-purple-300"></i>
                        <a href="tel:+94123456789" class="footer-link">+94 123 456 789</a>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-purple-300"></i>
                        <a href="mailto:support@fledge.com" class="footer-link">support@fledge.com</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-10 pt-6 border-t border-purple-700">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-purple-300 text-sm text-center md:text-left">
                    &copy; 2025 Fledge. All rights reserved.
                </p>
                <div class="mt-3 md:mt-0 flex space-x-4">
                    <a href="/privacy" class="text-purple-300 hover:text-white text-xs">Privacy Policy</a>
                    <a href="/terms" class="text-purple-300 hover:text-white text-xs">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer-link {
        @apply text-purple-200 hover:text-white transition-colors duration-300 flex items-center text-sm;
    }
    .social-icon {
        @apply w-8 h-8 flex items-center justify-center rounded-full bg-purple-800 hover:bg-purple-700 text-white hover:text-purple-100 transition-all duration-300;
    }
</style>
