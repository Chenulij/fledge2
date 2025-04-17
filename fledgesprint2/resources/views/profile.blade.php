<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile</title>
    @vite('resources/js/profile.js')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
    @include('components.navbar')

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden max-w-4xl mx-auto">
            <!-- Profile Header -->
            <div class="bg-purple-900 px-6 py-4">
                <h2 class="text-2xl font-semibold text-white">
                    <i class="fas fa-user-circle mr-2"></i> My Profile
                </h2>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mx-6 mt-4 rounded" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Form Container -->
            <div class="p-6 md:p-8">
                <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Profile Picture Section -->
                    <div class="flex flex-col items-center md:flex-row md:items-start space-y-6 md:space-y-0 md:space-x-8 mb-8">
                        <div class="relative">
                            <img id="preview" src="{{ $student->profile_picture ? asset('storage/' . $student->profile_picture) : asset('images/user.png') }}"
                                 alt="Profile"
                                 class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 shadow-sm">
                            <label id="profilePictureLabel" for="profilePicture" class="absolute bottom-0 right-0 bg-purple-700 text-white p-2 rounded-full cursor-pointer opacity-0 transition-opacity duration-300">
                                <i class="fas fa-camera"></i>
                                <input type="file" id="profilePicture" name="profile_picture" class="hidden" accept="image/*" disabled>
                            </label>
                        </div>
                        <div class="text-center md:text-left">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $student->first_name }} {{ $student->last_name }}</h3>
                            <p class="text-gray-600">{{ $student->email }}</p>
                            <p class="text-gray-600 mt-1">{{ $student->phone }}</p>
                        </div>
                    </div>

                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- First Name -->
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-user mr-1 text-purple-700"></i> First Name
                            </label>
                            <input type="text" id="firstName" name="first_name" value="{{ $student->first_name }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition" disabled>
                        </div>

                        <!-- Last Name -->
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-user mr-1 text-purple-700"></i> Last Name
                            </label>
                            <input type="text" id="lastName" name="last_name" value="{{ $student->last_name }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition" disabled>
                        </div>

                        <!-- Email -->
                        <div class="space-y-1">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-envelope mr-1 text-purple-700"></i> Email
                            </label>
                            <input type="email" id="email" name="email" value="{{ $student->email }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition" disabled>
                        </div>

                        <!-- Contact Number -->
                        <div class="space-y-1">
                            <label for="contact" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-phone mr-1 text-purple-700"></i> Contact Number
                            </label>
                            <input type="tel" id="contact" name="phone" value="{{ $student->phone }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition" disabled>
                        </div>

                        <!-- CV Upload -->
                        <div class="md:col-span-2 space-y-1">
                            <label class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-file-pdf mr-1 text-purple-700"></i> CV/Resume (PDF only)
                            </label>
                            <div class="flex items-center space-x-4">
                                <label class="flex-1">
                                    <div class="flex items-center justify-between px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 hover:bg-gray-50 cursor-pointer transition">
                                        <span id="cvFileName" class="text-gray-500 truncate">
                                            @if($student->cv)
                                                {{ basename($student->cv) }}
                                            @else
                                                No file chosen
                                            @endif
                                        </span>
                                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded text-sm">
                                            <i class="fas fa-upload mr-1"></i> Browse
                                        </span>
                                    </div>
                                    <input type="file" id="cv" name="cv" accept=".pdf" class="hidden" disabled>
                                </label>
                                @if($student->cv)
                                    <button type="button" onclick="openCV('{{ asset('storage/' . $student->cv) }}')"
                                            class="text-purple-700 hover:text-purple-900 p-2 rounded-full hover:bg-purple-50 transition"
                                            title="View CV">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="{{ asset('storage/' . $student->cv) }}" download
                                       class="text-purple-700 hover:text-purple-900 p-2 rounded-full hover:bg-purple-50 transition"
                                       title="Download CV">
                                        <i class="fas fa-download"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                        <button type="button" id="editButton"
                                class="flex items-center px-6 py-2 bg-purple-700 text-white rounded-lg hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition">
                            <i class="fas fa-edit mr-2"></i> Edit Profile
                        </button>
                        <button type="submit" id="saveButton"
                                class="hidden items-center px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition">
                            <i class="fas fa-save mr-2"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openCV(url) {
            // Open the PDF in a new tab
            window.open(url, '_blank');
        }

        document.addEventListener("DOMContentLoaded", () => {
            const editButton = document.getElementById("editButton");
            const saveButton = document.getElementById("saveButton");
            const form = document.getElementById("profileForm");
            const inputs = document.querySelectorAll("input:not([type='file'])");
            const fileInputs = document.querySelectorAll("input[type='file']");
            const profilePictureInput = document.getElementById("profilePicture");
            const profilePictureLabel = document.getElementById("profilePictureLabel");
            const cvInput = document.getElementById("cv");
            const cvFileName = document.getElementById("cvFileName");
            let isEditing = false;

            // Toggle edit mode
            editButton.addEventListener("click", () => {
                isEditing = true;

                // Enable all inputs
                inputs.forEach(input => {
                    input.disabled = false;
                    input.classList.remove("bg-gray-100", "text-gray-500");
                    input.classList.add("bg-white", "text-gray-800");
                });

                fileInputs.forEach(input => input.disabled = false);

                // Show profile picture edit button
                profilePictureLabel.classList.remove("opacity-0");

                // Enable CV upload styling
                const cvUploadDiv = cvInput.parentElement.querySelector('div');
                cvUploadDiv.classList.remove("bg-gray-100");
                cvUploadDiv.classList.add("bg-white", "hover:bg-gray-50", "cursor-pointer");
                cvUploadDiv.querySelector('span').classList.remove("bg-gray-200");
                cvUploadDiv.querySelector('span').classList.add("bg-gray-100", "hover:bg-gray-200");

                // Toggle buttons
                editButton.classList.add("hidden");
                saveButton.classList.remove("hidden");
            });

            // Preview profile picture
            profilePictureInput.addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = () => {
                    document.getElementById("preview").src = reader.result;
                };
                reader.readAsDataURL(file);
            });

            // Update CV file name display
            cvInput.addEventListener("change", function() {
                if (this.files && this.files[0]) {
                    // Validate PDF file
                    const file = this.files[0];
                    if (file.type !== "application/pdf") {
                        alert("Please upload a PDF file only.");
                        this.value = "";
                        cvFileName.textContent = "No file chosen";
                        return;
                    }
                    cvFileName.textContent = file.name;
                } else {
                    cvFileName.textContent = "No file chosen";
                }
            });
        });
    </script>
</body>
</html>
