document.addEventListener('DOMContentLoaded', function () {
    // Get form and elements
    const loginForm = document.querySelector('form[action*="login"]');
    const emailInput = document.getElementById('emailInput');
    const passwordInput = document.getElementById('passwordInput');

    // Set up CSRF token for AJAX requests
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (loginForm) {
        // Add real-time validation for email
        if (emailInput) {
            emailInput.addEventListener('blur', function () {
                validateEmail();
            });
        }

        // Add form submission handler
        loginForm.addEventListener('submit', function (e) {
            // Check form validity before submitting
            if (!validateEmail() || !validatePassword()) {
                e.preventDefault();
            }
        });
    }

    // Function to validate email
    function validateEmail() {
        if (!emailInput) return true;

        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Remove any existing error message
        removeErrorMessage(emailInput);

        if (email === '') {
            showErrorMessage(emailInput, 'Email is required');
            return false;
        }

        if (!emailRegex.test(email)) {
            showErrorMessage(emailInput, 'Please enter a valid email address');
            return false;
        }

        return true;
    }

    // Function to validate password
    function validatePassword() {
        if (!passwordInput) return true;

        // Remove any existing error message
        removeErrorMessage(passwordInput);

        if (passwordInput.value.trim() === '') {
            showErrorMessage(passwordInput, 'Password is required');
            return false;
        }

        return true;
    }

    // Function to show error message
    function showErrorMessage(element, message) {
        // Remove any existing error
        removeErrorMessage(element);

        // Create new error message
        const errorElement = document.createElement('div');
        errorElement.className = 'text-red-300 text-sm mt-1 login-error';
        errorElement.textContent = message;

        // Add to DOM after the input
        element.parentElement.appendChild(errorElement);
    }

    // Function to remove error message
    function removeErrorMessage(element) {
        const existingError = element.parentElement.querySelector('.login-error');
        if (existingError) {
            existingError.remove();
        }
    }

    const formElements = document.querySelectorAll('input, button');
    formElements.forEach((el, index) => {
        el.style.transitionDelay = `${index * 50}ms`;
        el.classList.add('transform', 'transition-all', 'duration-300', 'ease-out');

        // Initial state for animation
        el.classList.add('opacity-0', '-translate-y-2');

        // Animate in
        setTimeout(() => {
            el.classList.remove('opacity-0', '-translate-y-2');
        }, 100 + (index * 50));
    });

    // Enhance focus states
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.querySelector('label').classList.add('text-purple-900');
        });
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.querySelector('label').classList.remove('text-purple-900');
            }
        });
    });
});
