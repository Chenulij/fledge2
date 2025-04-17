document.addEventListener('DOMContentLoaded', function () {
    // Get elements
    const form = document.getElementById('register-form');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const studentIdInput = document.getElementById('student_id');
    const strengthBar = document.getElementById('password-strength-bar');
    const strengthText = document.getElementById('password-strength-text');
    const validationErrors = document.getElementById('validation-errors');
    const errorList = document.getElementById('error-list');

    // Setup CSRF token for all AJAX requests
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Add form animations
    const formElements = form.querySelectorAll('input, button, label');
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
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', function () {
            const label = this.parentElement.querySelector('label');
            if (label) label.classList.add('text-purple-900');
        });
        input.addEventListener('blur', function () {
            const label = this.parentElement.querySelector('label');
            if (label && !this.value) {
                label.classList.remove('text-purple-900');
            }
        });
    });

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            submitForm();
        });

        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            if (input.name === 'email' || input.name === 'phone' || input.name === 'student_id') {
                input.addEventListener('input', function () {
                    if (this.value.trim() !== '') {
                        validateField(this.name, this.value);
                    } else {
                        clearFieldError(this.name);
                    }
                });
            } else {
                input.addEventListener('blur', function () {
                    if (this.value.trim() !== '') {
                        validateField(this.name, this.value);
                    }
                });
            }
        });

        if (passwordInput) {
            passwordInput.addEventListener('input', updatePasswordStrength);
        }

        if (confirmPasswordInput) {
            confirmPasswordInput.addEventListener('input', validatePasswordMatch);
        }

        if (phoneInput) {
            phoneInput.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '').slice(0, 10);
                if (this.value.length > 0 && this.value.length !== 10) {
                    showFieldError('phone', 'Phone number must be exactly 10 digits.');
                } else {
                    clearFieldError('phone');
                }
            });
        }
    }

    function validateField(field, value) {
        if (field === 'password_confirmation') return;
        clearFieldError(field);

        fetch('/validate-field', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ field, value })
        })
            .then(response => response.json())
            .then(data => {
                if (!data.valid) {
                    showFieldError(field, data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function validateStudentIdUniqueness() {
        const studentId = studentIdInput.value;
        clearFieldError('student_id');

        if (studentId.trim() !== '') {
            fetch('/check-student-id', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ student_id: studentId })
            })
                .then(response => response.json())
                .then(data => {
                    if (!data.unique) {
                        showFieldError('student_id', 'Student ID is already registered.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }

    function validatePasswordMatch() {
        const password = passwordInput.value;
        const confirmation = confirmPasswordInput.value;
        clearFieldError('password_confirmation');

        if (confirmation !== '' && password !== confirmation) {
            showFieldError('password_confirmation', 'The password confirmation does not match.');
            return false;
        }
        return true;
    }

    function updatePasswordStrength() {
        const password = passwordInput.value;
        let strength = 0;
        let feedback = [];

        if (password.length >= 8) strength += 25;
        else feedback.push('At least 8 characters');

        if (/[a-z]/.test(password)) strength += 25;
        else feedback.push('At least one lowercase letter');

        if (/[A-Z]/.test(password)) strength += 25;
        else feedback.push('At least one uppercase letter');

        if (/\d/.test(password)) strength += 12.5;
        else feedback.push('At least one number');

        if (/[@$!%*#?&]/.test(password)) strength += 12.5;
        else feedback.push('At least one special character');

        strengthBar.style.width = strength + '%';
        strengthBar.className = strength < 50 ? 'bg-red-500 h-1.5 rounded-full transition-all duration-300' :
            strength < 75 ? 'bg-yellow-500 h-1.5 rounded-full transition-all duration-300' :
                'bg-green-500 h-1.5 rounded-full transition-all duration-300';
        strengthText.textContent = strength < 50 ? 'Weak' : strength < 75 ? 'Medium' : 'Strong';
        strengthText.className = strength < 50 ? 'text-xs font-medium text-red-500' :
            strength < 75 ? 'text-xs font-medium text-yellow-500' :
                'text-xs font-medium text-green-500';

        feedback.length > 0 && password !== '' ? showFieldError('password', 'Missing: ' + feedback.join(', ')) : clearFieldError('password');
    }

    function showFieldError(field, message) {
        const errorElement = document.getElementById(field + '-error');
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.parentElement.classList.add('has-error');

            // Add visual error state to input
            const input = document.getElementById(field);
            if (input) {
                input.classList.add('border-red-500', 'focus:ring-red-500');
                input.classList.remove('border-gray-300', 'focus:ring-purple-500', 'focus:border-purple-500');
            }
        }
    }

    function clearFieldError(field) {
        const errorElement = document.getElementById(field + '-error');
        if (errorElement) {
            errorElement.textContent = '';
            errorElement.parentElement.classList.remove('has-error');

            // Remove visual error state from input
            const input = document.getElementById(field);
            if (input) {
                input.classList.remove('border-red-500', 'focus:ring-red-500');
                input.classList.add('border-gray-300', 'focus:ring-purple-500', 'focus:border-purple-500');
            }
        }
    }

    function submitForm() {
        validationErrors.classList.add('hidden');
        errorList.innerHTML = '';

        if (!validatePasswordMatch()) return;
        if (phoneInput.value.length !== 10) {
            showFieldError('phone', 'Phone number must be 10 digits.');
            return;
        }

        validateStudentIdUniqueness();

        const formData = {
            first_name: document.getElementById('first_name').value,
            last_name: document.getElementById('last_name').value,
            email: emailInput.value,
            phone: phoneInput.value,
            student_id: studentIdInput.value,
            password: passwordInput.value,
            password_confirmation: confirmPasswordInput.value,
        };

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    if (data.authenticated) {
                        window.location.href = data.redirect;
                    } else {
                        window.location.href = '/login';
                    }
                } else {
                    showValidationErrors(data.errors || {});
                    alert(data.status === 'allow-error' ? 'Registration failed. Student ID is invalid.' : 'Registration failed. Please check your inputs.');
                }
            })
    }

    function showValidationErrors(errors) {
        errorList.innerHTML = '';
        validationErrors.classList.remove('hidden');
        Object.keys(errors).forEach(field => {
            const errorMessage = errors[field][0];
            errorList.appendChild(Object.assign(document.createElement('li'), { textContent: errorMessage }));
            showFieldError(field, errorMessage);
        });
        validationErrors.scrollIntoView({ behavior: 'smooth' });
    }
});




//employer js 

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('employer-register-form');
    const passwordField = document.getElementById('password');
    const passwordConfirmationField = document.getElementById('password_confirmation');
    const passwordStrengthBar = document.getElementById('password-strength-bar');
    const passwordStrengthText = document.getElementById('password-strength-text');
    const signupButton = document.getElementById('signup-button');

    const validatePasswordStrength = (password) => {
        const strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        const mediumRegex = /^(?=.*[a-z])(?=.*\d)[A-Za-z\d]{6,}$/;

        if (strongRegex.test(password)) {
            passwordStrengthBar.style.width = '100%';
            passwordStrengthText.textContent = 'Strong';
            passwordStrengthBar.classList.remove('bg-yellow-400', 'bg-red-400');
            passwordStrengthBar.classList.add('bg-green-500');
        } else if (mediumRegex.test(password)) {
            passwordStrengthBar.style.width = '60%';
            passwordStrengthText.textContent = 'Medium';
            passwordStrengthBar.classList.remove('bg-green-500', 'bg-red-400');
            passwordStrengthBar.classList.add('bg-yellow-400');
        } else {
            passwordStrengthBar.style.width = '30%';
            passwordStrengthText.textContent = 'Weak';
            passwordStrengthBar.classList.remove('bg-green-500', 'bg-yellow-400');
            passwordStrengthBar.classList.add('bg-red-400');
        }
    };

    const validatePasswordConfirmation = () => {
        const password = passwordField.value;
        const passwordConfirmation = passwordConfirmationField.value;
        if (password !== passwordConfirmation) {
            document.getElementById('password_confirmation-error').textContent = 'Passwords do not match.';
            return false;
        } else {
            document.getElementById('password_confirmation-error').textContent = '';
            return true;
        }
    };

    // Handle password strength validation on keyup
    passwordField.addEventListener('input', (e) => {
        validatePasswordStrength(e.target.value);
    });

    // Handle password confirmation validation on input
    passwordConfirmationField.addEventListener('input', validatePasswordConfirmation);

    // Handle form submission
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        // Clear previous error messages
        const errorList = document.getElementById('error-list');
        errorList.innerHTML = '';

        let hasErrors = false;

        // Basic validation for other fields
        const fields = ['company_name', 'email', 'phone', 'password', 'password_confirmation'];
        fields.forEach((field) => {
            const fieldElement = document.getElementById(field);
            if (!fieldElement.value) {
                const errorMessage = `${field.replace('_', ' ')} is required.`;
                const errorElement = document.getElementById(`${field}-error`);
                errorElement.textContent = errorMessage;
                hasErrors = true;
            } else {
                const errorElement = document.getElementById(`${field}-error`);
                errorElement.textContent = '';
            }
        });

        if (!hasErrors && validatePasswordConfirmation()) {
            form.submit();
        } else {
            document.getElementById('validation-errors').classList.remove('hidden');
        }
    });


    document.getElementById('employer-register-form').addEventListener('submit', async function (e) {
        e.preventDefault();

        const form = e.target;
        const data = new FormData(form);
        const errorsContainer = document.getElementById('validation-errors');
        const errorList = document.getElementById('error-list');
        errorsContainer.classList.add('hidden');
        errorList.innerHTML = '';

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: data
            });

            const result = await response.json();

            if (!response.ok) {
                if (result.errors) {
                    errorsContainer.classList.remove('hidden');
                    for (let field in result.errors) {
                        const messages = result.errors[field];
                        messages.forEach(msg => {
                            errorList.innerHTML += `<li>${msg}</li>`;
                        });

                        const errorField = document.getElementById(`${field}-error`);
                        if (errorField) {
                            errorField.textContent = messages[0];
                        }
                    }
                } else {
                    alert(result.message || 'Something went wrong.');
                }
            } else {
                window.location.href = result.redirect;
            }
        } catch (error) {
            alert('Server error occurred.');
        }
    });

    const passwordInput = document.getElementById('password');
    const strengthBar = document.getElementById('password-strength-bar');
    const strengthText = document.getElementById('password-strength-text');

    passwordInput.addEventListener('input', () => {
        const val = passwordInput.value;
        let strength = 0;
        if (val.length >= 8) strength++;
        if (/[A-Z]/.test(val)) strength++;
        if (/[0-9]/.test(val)) strength++;
        if (/[^A-Za-z0-9]/.test(val)) strength++;

        const strengthLevels = ['None', 'Weak', 'Moderate', 'Strong', 'Very Strong'];
        const colors = ['gray', 'red', 'yellow', 'green', 'purple'];

        strengthBar.style.width = `${(strength / 4) * 100}%`;
        strengthBar.style.backgroundColor = colors[strength];
        strengthText.textContent = strengthLevels[strength];
    });


});
