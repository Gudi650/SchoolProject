<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment - School Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideInFromBottom {
            from {
                opacity: 0;
                transform: translateY(1rem);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        .animate-slide-in {
            animation: slideInFromBottom 0.5s ease-in-out;
        }
        .animate-zoom-in {
            animation: zoomIn 0.5s ease-in-out;
        }
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        select::-ms-expand {
            display: none;
        }
        .hidden-form {
            display: none;
        }
        .active-form {
            display: block;
        }
    </style>
</head>
<body class="bg-slate-50">
    <!-- Step 1: Personal Info -->
    <div id="step-1" class="hidden-form">
        <div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-10 text-center">
                    <div class="inline-flex items-center justify-center p-3 bg-blue-600 rounded-xl shadow-lg mb-4">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Student Enrollment</h1>
                    <p class="mt-2 text-slate-600">New student registration form for academic year 2024-2025</p>
                </div>

                <!-- Main Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <!-- Progress Header -->
                    <div class="bg-slate-50 px-6 py-8 border-b border-slate-200">
                        <div class="w-full py-4">
                            <div class="relative flex items-center justify-between w-full">
                                <!-- Progress Bar Background -->
                                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-slate-200 rounded-full -z-10"></div>
                                <!-- Active Progress Bar -->
                                <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-blue-600 rounded-full -z-10 transition-all duration-500" style="width: 0%"></div>

                                <!-- Step 1 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 scale-110 ring-4 ring-blue-50 z-10">
                                        <span class="text-sm font-semibold">1</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Personal Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Personal</span>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-slate-300 text-slate-400 z-10">
                                        <span class="text-sm font-semibold">2</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Contact Details</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Contact</span>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-slate-300 text-slate-400 z-10">
                                        <span class="text-sm font-semibold">3</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Guardian Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Guardian</span>
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-slate-300 text-slate-400 z-10">
                                        <span class="text-sm font-semibold">4</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Academic Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Academic</span>
                                    </div>
                                </div>

                                <!-- Step 5 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-slate-300 text-slate-400 z-10">
                                        <span class="text-sm font-semibold">5</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Documents</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Documents</span>
                                    </div>
                                </div>

                                <!-- Step 6 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-slate-300 text-slate-400 z-10">
                                        <span class="text-sm font-semibold">6</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Review & Submit</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Review</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Step Label -->
                            <div class="mt-6 md:hidden text-center">
                                <p class="text-sm font-medium text-slate-900">
                                    <span class="text-slate-600">Personal Info</span>
                                </p>
                                <p class="text-xs text-slate-500 mt-1">Step 1 of 6</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Content -->
                    <div class="p-6 md:p-10 min-h-[400px]">
                        <div class="max-w-3xl mx-auto space-y-6 animate-slide-in">
                            <!-- Student Photo Upload -->
                            <div class="w-full">
                                <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                    Student Passport Photo
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                
                                <div class="flex flex-col sm:flex-row gap-4 items-start">
                                    <!-- Preview Area -->
                                    <div class="flex-shrink-0">
                                        <div class="relative w-32 h-40 rounded-lg border-2 border-slate-300 bg-slate-100 overflow-hidden">
                                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                                                <svg class="w-12 h-12 mb-2" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                                <span class="text-xs font-medium">No photo</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Upload Area -->
                                    <div class="flex-1 w-full">
                                        <div class="relative border-2 border-dashed border-slate-300 bg-slate-50 rounded-lg hover:border-slate-400 transition-all duration-200">
                                            <input type="file" id="photoInput" class="hidden" accept="image/jpeg,image/jpg,image/png" />
                                            
                                            <div class="p-6 text-center">
                                                <svg class="mx-auto h-8 w-8 mb-3 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                                    <circle cx="12" cy="13" r="4"></circle>
                                                </svg>
                                                <div class="mb-2">
                                                    <button type="button" onclick="document.getElementById('photoInput').click()" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-8 px-3 text-xs bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 focus:ring-slate-500 shadow-sm">
                                                        Choose Photo
                                                    </button>
                                                </div>
                                                <p class="text-xs text-slate-500 mb-1">or drag and drop image here</p>
                                                <p class="text-xs text-slate-400">Passport size photo • Max 2MB</p>
                                                <p class="text-xs text-slate-400">JPG, PNG formats</p>
                                            </div>
                                        </div>
                                        
                                        <p class="mt-1.5 text-xs text-slate-500">Upload a recent passport-size photograph with plain background</p>
                                    </div>
                                </div>
                            </div>

                            <!-- First and Last Name -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        First Name
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" placeholder="e.g. John" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Mid Name
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" placeholder="e.g. Doe" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Last Name
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" placeholder="e.g. john" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                </div>
                            </div>

                            <!-- Date of Birth, Gender, Blood Group -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Date of Birth
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="date" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Gender
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <div class="relative">
                                        <select class="flex h-10 w-full appearance-none rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200">
                                            <option value="" disabled selected>Select gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <svg class="absolute right-3 top-3 h-4 w-4 text-slate-400 pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        School You want to enroll
                                    </label>

                                    <!--a dropdown for user to select school-->
                                    <div class="relative">
                                        <select class="flex h-10 w-full appearance-none rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200">
                                            <option value="" disabled selected>Select a school</option>
                                            <option value="school-a">School A</option>
                                            <option value="school-b">School B</option>
                                            <option value="school-c">School C</option>
                                        </select>
                                        <svg class="absolute right-3 top-3 h-4 w-4 text-slate-400 pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                        <button disabled class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none h-10 px-4 py-2 text-sm bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500 invisible">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            Back
                        </button>

                        <div class="flex items-center gap-4">
                            <button onclick="goToStep(2)" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 shadow-sm">
                                Next Step
                                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <p class="text-center text-slate-400 text-sm mt-8">
                    &copy; {{ now()->year }} School Management System. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <!-- Step 2: Contact Info -->
    <div id="step-2" class="hidden-form">
        <div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-10 text-center">
                    <div class="inline-flex items-center justify-center p-3 bg-blue-600 rounded-xl shadow-lg mb-4">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Student Enrollment</h1>
                    <p class="mt-2 text-slate-600">New student registration form for academic year 2024-2025</p>
                </div>

                <!-- Main Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <!-- Progress Header -->
                    <div class="bg-slate-50 px-6 py-8 border-b border-slate-200">
                        <div class="w-full py-4">
                            <div class="relative flex items-center justify-between w-full">
                                <!-- Progress Bar Background -->
                                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-slate-200 rounded-full -z-10"></div>
                                <!-- Active Progress Bar -->
                                <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-blue-600 rounded-full -z-10 transition-all duration-500" style="width: 16.66%"></div>

                                <!-- Step 1 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Personal Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Personal</span>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 scale-110 ring-4 ring-blue-50 z-10">
                                        <span class="text-sm font-semibold">2</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Contact Details</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Contact</span>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-slate-300 text-slate-400 z-10">
                                        <span class="text-sm font-semibold">3</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Guardian Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Guardian</span>
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-slate-300 text-slate-400 z-10">
                                        <span class="text-sm font-semibold">4</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Academic Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Academic</span>
                                    </div>
                                </div>

                                <!-- Step 5 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-slate-300 text-slate-400 z-10">
                                        <span class="text-sm font-semibold">5</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Documents</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Documents</span>
                                    </div>
                                </div>

                                <!-- Step 6 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-slate-300 text-slate-400 z-10">
                                        <span class="text-sm font-semibold">6</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Review & Submit</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Review</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Step Label -->
                            <div class="mt-6 md:hidden text-center">
                                <p class="text-sm font-medium text-slate-900">
                                    <span class="text-slate-600">Contact Details</span>
                                </p>
                                <p class="text-xs text-slate-500 mt-1">Step 2 of 6</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Content -->
                    <div class="p-6 md:p-10 min-h-[400px]">
                        <div class="max-w-3xl mx-auto space-y-6 animate-slide-in">
                            <!-- Email and Phone -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Email Address
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="email" placeholder="student@example.com" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Phone Number
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="tel" placeholder="(555) 123-4567" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                </div>
                            </div>

                            <!-- Street Address -->
                            <div class="space-y-6">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Street Address
                                        
                                    </label>
                                    <input type="text" placeholder="123 Education Lane" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                </div>

                                <!-- City, State, Postal Code -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="w-full">
                                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                            City
                                            
                                        </label>
                                        <input type="text" placeholder="New York" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                    </div>
                                    <div class="w-full">
                                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                            District
                                            
                                        </label>
                                        <input type="text" placeholder="NY" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                    </div>
                                    <div class="w-full">
                                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                            Ward
                                        </label>
                                        <input type="text" placeholder="NY" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                        <button onclick="goToStep(1)" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            Back
                        </button>

                        <div class="flex items-center gap-4">
                            <button onclick="goToStep(3)" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 shadow-sm">
                                Next Step
                                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <p class="text-center text-slate-400 text-sm mt-8">
                    &copy; {{ now()->year }} School Management System. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <!-- Step 3: Guardian Info -->
    <div id="step-3" class="hidden-form">
        <div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-10 text-center">
                    <div class="inline-flex items-center justify-center p-3 bg-blue-600 rounded-xl shadow-lg mb-4">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Student Enrollment</h1>
                    <p class="mt-2 text-slate-600">New student registration form for academic year 2024-2025</p>
                </div>

                <!-- Main Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <!-- Progress Header -->
                    <div class="bg-slate-50 px-6 py-8 border-b border-slate-200">
                        <div class="w-full py-4">
                            <div class="relative flex items-center justify-between w-full">
                                <!-- Progress Bar Background -->
                                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-slate-200 rounded-full -z-10"></div>
                                <!-- Active Progress Bar -->
                                <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-blue-600 rounded-full -z-10 transition-all duration-500" style="width: 33.33%"></div>

                                <!-- Step 1 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Personal Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Personal</span>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Contact Details</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Contact</span>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 scale-110 ring-4 ring-blue-50 z-10">
                                        <span class="text-sm font-semibold">3</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Guardian Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Guardian</span>
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-slate-300 text-slate-400 z-10">
                                        <span class="text-sm font-semibold">4</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Academic Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Academic</span>
                                    </div>
                                </div>

                                <!-- Step 5 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-slate-300 text-slate-400 z-10">
                                        <span class="text-sm font-semibold">5</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Documents</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Documents</span>
                                    </div>
                                </div>

                                <!-- Step 6 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-slate-300 text-slate-400 z-10">
                                        <span class="text-sm font-semibold">6</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Review & Submit</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Review</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Step Label -->
                            <div class="mt-6 md:hidden text-center">
                                <p class="text-sm font-medium text-slate-900">
                                    <span class="text-slate-600">Guardian Info</span>
                                </p>
                                <p class="text-xs text-slate-500 mt-1">Step 3 of 6</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Content -->
                    <div class="p-6 md:p-10 min-h-[400px]">
                        <div class="max-w-3xl mx-auto space-y-6 animate-slide-in">
                            <!-- Guardian Name and Relationship -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        First Name
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" placeholder="e.g. Jane Doe" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Mid Name
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" placeholder="e.g. Jane Doe" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        last Name
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" placeholder="e.g. Jane Doe" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                </div>
                                
                            </div>

                            <!-- Guardian Phone and Email -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Guardian Phone
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="tel" placeholder="(555) 987-6543" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Guardian Email
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="email" placeholder="guardian@example.com" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Relationship
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <div class="relative">
                                        <select class="flex h-10 w-full appearance-none rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200">
                                            <option value="" disabled selected>Select an option</option>
                                            <option value="father">Father</option>
                                            <option value="mother">Mother</option>
                                            <option value="guardian">Legal Guardian</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <svg class="absolute right-3 top-3 h-4 w-4 text-slate-400 pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                        <button onclick="goToStep(2)" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            Back
                        </button>

                        <div class="flex items-center gap-4">
                            <button onclick="goToStep(4)" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 shadow-sm">
                                Next Step
                                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <p class="text-center text-slate-400 text-sm mt-8">
                    &copy; {{ now()->year }} School Management System. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <!-- Step 4: Academic Info -->
    <div id="step-4" class="hidden-form">
        <div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-10 text-center">
                    <div class="inline-flex items-center justify-center p-3 bg-blue-600 rounded-xl shadow-lg mb-4">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Student Enrollment</h1>
                    <p class="mt-2 text-slate-600">New student registration form for academic year 2024-2025</p>
                </div>

                <!-- Main Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <!-- Progress Header -->
                    <div class="bg-slate-50 px-6 py-8 border-b border-slate-200">
                        <div class="w-full py-4">
                            <div class="relative flex items-center justify-between w-full">
                                <!-- Progress Bar Background -->
                                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-slate-200 rounded-full -z-10"></div>
                                <!-- Active Progress Bar -->
                                <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-blue-600 rounded-full -z-10 transition-all duration-500" style="width: 50%"></div>

                                <!-- Step 1 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Personal Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Personal</span>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Contact Details</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Contact</span>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Guardian Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Guardian</span>
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 scale-110 ring-4 ring-blue-50 z-10">
                                        <span class="text-sm font-semibold">4</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Academic Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Academic</span>
                                    </div>
                                </div>

                                <!-- Step 5 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-slate-300 text-slate-400 z-10">
                                        <span class="text-sm font-semibold">5</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Documents</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Documents</span>
                                    </div>
                                </div>

                                <!-- Step 6 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-slate-300 text-slate-400 z-10">
                                        <span class="text-sm font-semibold">6</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Review & Submit</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Review</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Step Label -->
                            <div class="mt-6 md:hidden text-center">
                                <p class="text-sm font-medium text-slate-900">
                                    <span class="text-slate-600">Academic Info</span>
                                </p>
                                <p class="text-xs text-slate-500 mt-1">Step 4 of 6</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Content -->
                    <div class="p-6 md:p-10 min-h-[400px]">
                        <div class="max-w-3xl mx-auto space-y-6 animate-slide-in">
                            <!-- Info Banner -->
                            <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg mb-6">
                                <p class="text-sm text-blue-800">
                                    <span class="font-semibold">Note:</span> Student ID is automatically generated by the system for new enrollments.
                                </p>
                            </div>

                            <!-- Student ID and Grade -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Student ID
                                    </label>
                                    <input type="text" value="STU-2024-001234" disabled class="flex h-10 w-full rounded-lg border border-slate-300 bg-slate-100 text-slate-500 font-mono px-3 py-2 text-sm focus:outline-none cursor-not-allowed" />
                                    <p class="mt-1.5 text-xs text-slate-500">Auto-generated unique identifier</p>
                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Grade / Class Applying For
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <div class="relative">
                                        <select class="flex h-10 w-full appearance-none rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200">
                                            <option value="" disabled selected>Select an option</option>
                                            <option value="grade-1">Grade 1</option>
                                            <option value="grade-2">Grade 2</option>
                                            <option value="grade-3">Grade 3</option>
                                            <option value="grade-4">Grade 4</option>
                                            <option value="grade-5">Grade 5</option>
                                            <option value="grade-6">Grade 6</option>
                                            <option value="grade-7">Grade 7</option>
                                            <option value="grade-8">Grade 8</option>
                                            <option value="grade-9">Grade 9</option>
                                            <option value="grade-10">Grade 10</option>
                                            <option value="grade-11">Grade 11</option>
                                            <option value="grade-12">Grade 12</option>
                                        </select>
                                        <svg class="absolute right-3 top-3 h-4 w-4 text-slate-400 pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Previous School and Admission Date -->
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Previous School
                                    </label>
                                    <input type="text" placeholder="Enter previous school name" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                </div>
                                
                                <div class="w-full">
                                    <!--
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        School You want to enroll
                                    </label> -->

                                    <!--a dropdown for user to select school
                                    <div class="relative">
                                        <select class="flex h-10 w-full appearance-none rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200">
                                            <option value="" disabled selected>Select a school</option>
                                            <option value="school-a">School A</option>
                                            <option value="school-b">School B</option>
                                            <option value="school-c">School C</option>
                                        </select>
                                        <svg class="absolute right-3 top-3 h-4 w-4 text-slate-400 pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>

                                    </div> -->
                                    
                                </div>
                            </div>

                            <!-- Previous academic records -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Previous Grades / Previous Division
                                    </label>
                                    <input type="text" placeholder="grade or division" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                    <p class="mt-1.5 text-xs text-slate-500">Input the correct data, any mismatch will automatically be disqualified</p>
                                </div>

                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Admission Date
                                        
                                    </label>
                                    <input type="date" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                    <p class="mt-1.5 text-xs text-slate-500">Student's admission date in previous school</p>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                        <button onclick="goToStep(3)" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            Back
                        </button>

                        <div class="flex items-center gap-4">
                            <button onclick="goToStep(5)" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 shadow-sm">
                                Next Step
                                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <p class="text-center text-slate-400 text-sm mt-8">
                    &copy; {{ now()->year }} School Management System. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <!-- Step 5: Documents -->
    <div id="step-5" class="hidden-form">
        <div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-10 text-center">
                    <div class="inline-flex items-center justify-center p-3 bg-blue-600 rounded-xl shadow-lg mb-4">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Student Enrollment</h1>
                    <p class="mt-2 text-slate-600">New student registration form for academic year 2024-2025</p>
                </div>

                <!-- Main Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <!-- Progress Header -->
                    <div class="bg-slate-50 px-6 py-8 border-b border-slate-200">
                        <div class="w-full py-4">
                            <div class="relative flex items-center justify-between w-full">
                                <!-- Progress Bar Background -->
                                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-slate-200 rounded-full -z-10"></div>
                                <!-- Active Progress Bar -->
                                <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-blue-600 rounded-full -z-10 transition-all duration-500" style="width: 66.66%"></div>

                                <!-- Step 1 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Personal Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Personal</span>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Contact Details</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Contact</span>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Guardian Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Guardian</span>
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Academic Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Academic</span>
                                    </div>
                                </div>

                                <!-- Step 5 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 scale-110 ring-4 ring-blue-50 z-10">
                                        <span class="text-sm font-semibold">5</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Documents</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Documents</span>
                                    </div>
                                </div>

                                <!-- Step 6 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-slate-300 text-slate-400 z-10">
                                        <span class="text-sm font-semibold">6</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Review & Submit</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-slate-400">Review</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Step Label -->
                            <div class="mt-6 md:hidden text-center">
                                <p class="text-sm font-medium text-slate-900">
                                    <span class="text-slate-600">Documents</span>
                                </p>
                                <p class="text-xs text-slate-500 mt-1">Step 5 of 6</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Content -->
                    <div class="p-6 md:p-10 min-h-[400px]">
                        <div class="max-w-3xl mx-auto space-y-8 animate-slide-in">
                            <!-- Info Banner -->
                            <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg flex gap-3">
                                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-blue-900 mb-1">
                                        Document Upload Requirements
                                    </p>
                                    <p class="text-sm text-blue-700">
                                        Please upload clear, legible copies of all required documents.
                                        Accepted formats: PDF, JPG, PNG. Maximum file size: 5MB per document.
                                    </p>
                                </div>
                            </div>

                            <!-- File Upload Sections -->
                            <div class="space-y-6">
                                <!-- Academic Records -->
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Academic Records from Previous School
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    
                                    <div class="relative border-2 border-dashed border-slate-300 bg-slate-50 rounded-lg hover:border-slate-400 transition-all duration-200">
                                        <input type="file" id="academicRecords" class="hidden" accept=".pdf,.jpg,.jpeg,.png" multiple />
                                        
                                        <div class="p-6 text-center">
                                            <svg class="mx-auto h-10 w-10 mb-3 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="17 8 12 3 7 8"></polyline>
                                                <line x1="12" y1="3" x2="12" y2="15"></line>
                                            </svg>
                                            <div class="mb-2">
                                                <button type="button" onclick="document.getElementById('academicRecords').click()" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-8 px-3 text-xs bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 focus:ring-slate-500 shadow-sm">
                                                    Choose Files
                                                </button>
                                            </div>
                                            <p class="text-xs text-slate-500">
                                                or drag and drop files here
                                            </p>
                                            <p class="text-xs text-slate-400 mt-1">
                                                Max size: 5MB per file
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <p class="mt-1.5 text-xs text-slate-500">Upload transcripts, grade sheets, or academic certificates</p>
                                    
                                    <!-- File List Container -->
                                    <div id="academicRecordsList" class="mt-3 space-y-2 hidden"></div>
                                </div>

                                <!-- Previous Report Cards -->
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Previous Report Cards
                                    </label>
                                    
                                    <div class="relative border-2 border-dashed border-slate-300 bg-slate-50 rounded-lg hover:border-slate-400 transition-all duration-200">
                                        <input type="file" id="reportCards" class="hidden" accept=".pdf,.jpg,.jpeg,.png" multiple />
                                        
                                        <div class="p-6 text-center">
                                            <svg class="mx-auto h-10 w-10 mb-3 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="17 8 12 3 7 8"></polyline>
                                                <line x1="12" y1="3" x2="12" y2="15"></line>
                                            </svg>
                                            <div class="mb-2">
                                                <button type="button" onclick="document.getElementById('reportCards').click()" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-8 px-3 text-xs bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 focus:ring-slate-500 shadow-sm">
                                                    Choose Files
                                                </button>
                                            </div>
                                            <p class="text-xs text-slate-500">
                                                or drag and drop files here
                                            </p>
                                            <p class="text-xs text-slate-400 mt-1">
                                                Max size: 5MB per file
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <p class="mt-1.5 text-xs text-slate-500">Last 2 years of report cards (if available)</p>
                                    
                                    <!-- File List Container -->
                                    <div id="reportCardsList" class="mt-3 space-y-2 hidden"></div>
                                </div>

                                <!-- Transfer Certificate -->
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Transfer Certificate (TC)
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    
                                    <div class="relative border-2 border-dashed border-slate-300 bg-slate-50 rounded-lg hover:border-slate-400 transition-all duration-200">
                                        <input type="file" id="transferCert" class="hidden" accept=".pdf,.jpg,.jpeg,.png" />
                                        
                                        <div class="p-6 text-center">
                                            <svg class="mx-auto h-10 w-10 mb-3 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="17 8 12 3 7 8"></polyline>
                                                <line x1="12" y1="3" x2="12" y2="15"></line>
                                            </svg>
                                            <div class="mb-2">
                                                <button type="button" onclick="document.getElementById('transferCert').click()" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-8 px-3 text-xs bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 focus:ring-slate-500 shadow-sm">
                                                    Choose File
                                                </button>
                                            </div>
                                            <p class="text-xs text-slate-500">
                                                or drag and drop a file here
                                            </p>
                                            <p class="text-xs text-slate-400 mt-1">
                                                Max size: 5MB per file
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <p class="mt-1.5 text-xs text-slate-500">Official transfer certificate from previous institution</p>
                                    
                                    <!-- File List Container -->
                                    <div id="transferCertList" class="mt-3 space-y-2 hidden"></div>
                                </div>

                                <!-- Birth Certificate -->
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Birth Certificate
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    
                                    <div class="relative border-2 border-dashed border-slate-300 bg-slate-50 rounded-lg hover:border-slate-400 transition-all duration-200">
                                        <input type="file" id="birthCert" class="hidden" accept=".pdf,.jpg,.jpeg,.png" />
                                        
                                        <div class="p-6 text-center">
                                            <svg class="mx-auto h-10 w-10 mb-3 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="17 8 12 3 7 8"></polyline>
                                                <line x1="12" y1="3" x2="12" y2="15"></line>
                                            </svg>
                                            <div class="mb-2">
                                                <button type="button" onclick="document.getElementById('birthCert').click()" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-8 px-3 text-xs bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 focus:ring-slate-500 shadow-sm">
                                                    Choose File
                                                </button>
                                            </div>
                                            <p class="text-xs text-slate-500">
                                                or drag and drop a file here
                                            </p>
                                            <p class="text-xs text-slate-400 mt-1">
                                                Max size: 5MB per file
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <p class="mt-1.5 text-xs text-slate-500">Government-issued birth certificate for age verification</p>
                                    
                                    <!-- File List Container -->
                                    <div id="birthCertList" class="mt-3 space-y-2 hidden"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                        <button onclick="goToStep(4)" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            Back
                        </button>

                        <div class="flex items-center gap-4">
                            <button onclick="goToStep(6)" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 shadow-sm">
                                Next Step
                                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </button>
                        </div>
                    </div>
                    
                </div>

                <p class="text-center text-slate-400 text-sm mt-8">
                    &copy; {{ now()->year }} School Management System. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <!-- Step 6: Review & Submit -->
    <div id="step-6" class="hidden-form">
        <div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-10 text-center">
                    <div class="inline-flex items-center justify-center p-3 bg-blue-600 rounded-xl shadow-lg mb-4">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Student Enrollment</h1>
                    <p class="mt-2 text-slate-600">New student registration form for academic year 2024-2025</p>
                </div>

                <!-- Main Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <!-- Progress Header -->
                    <div class="bg-slate-50 px-6 py-8 border-b border-slate-200">
                        <div class="w-full py-4">
                            <div class="relative flex items-center justify-between w-full">
                                <!-- Progress Bar Background -->
                                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-slate-200 rounded-full -z-10"></div>
                                <!-- Active Progress Bar -->
                                <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-blue-600 rounded-full -z-10 transition-all duration-500" style="width: 83.33%"></div>

                                <!-- Step 1 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Personal Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Personal</span>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Contact Details</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Contact</span>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Guardian Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Guardian</span>
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Academic Info</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Academic</span>
                                    </div>
                                </div>

                                <!-- Step 5 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Documents</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Documents</span>
                                    </div>
                                </div>

                                <!-- Step 6 -->
                                <div class="flex flex-col items-center group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 scale-110 ring-4 ring-blue-50 z-10">
                                        <span class="text-sm font-semibold">6</span>
                                    </div>
                                    <div class="absolute mt-10 hidden lg:flex flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Review & Submit</span>
                                    </div>
                                    <div class="absolute mt-10 hidden md:flex lg:hidden flex-col items-center">
                                        <span class="text-xs font-semibold whitespace-nowrap text-blue-700">Review</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Step Label -->
                            <div class="mt-6 md:hidden text-center">
                                <p class="text-sm font-medium text-slate-900">
                                    <span class="text-slate-600">Review & Submit</span>
                                </p>
                                <p class="text-xs text-slate-500 mt-1">Step 6 of 6</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Content -->
                    <div class="p-6 md:p-10 min-h-[400px]">
                        <div class="max-w-3xl mx-auto space-y-6 animate-slide-in">
                            <!-- Header -->
                            <div class="text-center mb-8">
                                <h2 class="text-xl font-semibold text-slate-900">
                                    Review Enrollment Details
                                </h2>
                                <p class="text-slate-500 mt-1">
                                    Please ensure all information is correct before submitting.
                                </p>
                            </div>

                            <!-- Personal Information Section -->
                            <div class="bg-white rounded-lg border border-slate-200 overflow-hidden mb-6">
                                <div class="flex items-center justify-between px-6 py-4 bg-slate-50 border-b border-slate-200">
                                    <h3 class="font-semibold text-slate-800">Personal Information</h3>
                                    <button onclick="goToStep(1)" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-8 px-3 text-xs bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
                                        <svg class="w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        Edit
                                    </button>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-start gap-6 mb-6">
                                        <div class="flex-shrink-0">
                                            <div class="w-24 h-32 rounded-lg border-2 border-slate-200 overflow-hidden bg-slate-100">
                                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                                                    <svg class="w-8 h-8" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="12" cy="7" r="4"></circle>
                                                    </svg>
                                                    <span class="text-xs mt-1">No photo</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="flex flex-col">
                                                <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Full Name</span>
                                                <span class="text-sm text-slate-900 font-medium">John Doe</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Date of Birth</span>
                                                <span class="text-sm text-slate-900 font-medium">2010-05-15</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Gender</span>
                                                <span class="text-sm text-slate-900 font-medium">Male</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Blood Group</span>
                                                <span class="text-sm text-slate-900 font-medium">O+</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Details Section -->
                            <div class="bg-white rounded-lg border border-slate-200 overflow-hidden mb-6">
                                <div class="flex items-center justify-between px-6 py-4 bg-slate-50 border-b border-slate-200">
                                    <h3 class="font-semibold text-slate-800">Contact Details</h3>
                                    <button onclick="goToStep(2)" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-8 px-3 text-xs bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
                                        <svg class="w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        Edit
                                    </button>
                                </div>
                                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Email</span>
                                        <span class="text-sm text-slate-900 font-medium">student@example.com</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Phone</span>
                                        <span class="text-sm text-slate-900 font-medium">(555) 123-4567</span>
                                    </div>
                                    <div class="flex flex-col col-span-2">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Address</span>
                                        <span class="text-sm text-slate-900 font-medium">123 Education Lane, New York, NY 10001</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Guardian Information Section -->
                            <div class="bg-white rounded-lg border border-slate-200 overflow-hidden mb-6">
                                <div class="flex items-center justify-between px-6 py-4 bg-slate-50 border-b border-slate-200">
                                    <h3 class="font-semibold text-slate-800">Guardian Information</h3>
                                    <button onclick="goToStep(3)" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-8 px-3 text-xs bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
                                        <svg class="w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        Edit
                                    </button>
                                </div>
                                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Guardian Name</span>
                                        <span class="text-sm text-slate-900 font-medium">Jane Doe</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Relationship</span>
                                        <span class="text-sm text-slate-900 font-medium">Mother</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Phone</span>
                                        <span class="text-sm text-slate-900 font-medium">(555) 987-6543</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Email</span>
                                        <span class="text-sm text-slate-900 font-medium">guardian@example.com</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Academic Information Section -->
                            <div class="bg-white rounded-lg border border-slate-200 overflow-hidden mb-6">
                                <div class="flex items-center justify-between px-6 py-4 bg-slate-50 border-b border-slate-200">
                                    <h3 class="font-semibold text-slate-800">Academic Information</h3>
                                    <button onclick="goToStep(4)" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-8 px-3 text-xs bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
                                        <svg class="w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        Edit
                                    </button>
                                </div>
                                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Student ID</span>
                                        <span class="text-sm text-slate-900 font-medium">STU-2024-001234</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Grade Applied For</span>
                                        <span class="text-sm text-slate-900 font-medium">Grade 8</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Previous School</span>
                                        <span class="text-sm text-slate-900 font-medium">Lincoln Elementary School</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Admission Date</span>
                                        <span class="text-sm text-slate-900 font-medium">2024-09-01</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Uploaded Documents Section -->
                            <div class="bg-white rounded-lg border border-slate-200 overflow-hidden mb-6">
                                <div class="flex items-center justify-between px-6 py-4 bg-slate-50 border-b border-slate-200">
                                    <h3 class="font-semibold text-slate-800">Uploaded Documents</h3>
                                    <button onclick="goToStep(5)" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-8 px-3 text-xs bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
                                        <svg class="w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        Edit
                                    </button>
                                </div>
                                <div class="p-6 space-y-4">
                                    <div>
                                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Academic Records</p>
                                        <div id="reviewAcademicRecords" class="space-y-2">
                                            <span class="text-sm text-slate-400">No files uploaded</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Transfer Certificate</p>
                                        <div id="reviewTransferCert" class="space-y-2">
                                            <span class="text-sm text-slate-400">No files uploaded</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Birth Certificate</p>
                                        <div id="reviewBirthCert" class="space-y-2">
                                            <span class="text-sm text-slate-400">No files uploaded</span>
                                        </div>
                                    </div>
                                    <div id="reviewReportCardsSection" class="hidden">
                                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Previous Report Cards</p>
                                        <div id="reviewReportCards" class="space-y-2">
                                            <span class="text-sm text-slate-400">No files uploaded</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                        <button onclick="goToStep(5)" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            Back
                        </button>

                        <div class="flex items-center gap-4">
                            <button onclick="submitEnrollment()" class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 shadow-sm">
                                Submit Enrollment
                                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <p class="text-center text-slate-400 text-sm mt-8">
                    &copy; {{ now()->year }} School Management System. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <script>
        // File upload handlers
        const fileUploadHandlers = {
            academicRecords: [],
            reportCards: [],
            transferCert: null,
            birthCert: null
        };

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }

        function createFileListItem(file, index, onRemove) {
            const div = document.createElement('div');
            div.className = 'flex items-center justify-between p-3 bg-white border border-slate-200 rounded-lg group hover:border-slate-300 transition-colors';
            div.innerHTML = `
                <div class="flex items-center gap-3 flex-1 min-w-0">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-900 truncate">${file.name}</p>
                        <p class="text-xs text-slate-500">${formatFileSize(file.size)}</p>
                    </div>
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <button type="button" class="ml-3 p-1 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            `;
            
            div.querySelector('button').addEventListener('click', () => onRemove(index));
            return div;
        }

        function setupFileUpload(inputId, listId, isMultiple) {
            const input = document.getElementById(inputId);
            const listContainer = document.getElementById(listId);
            const storageKey = inputId;
            
            input.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                const validFiles = files.filter(file => file.size <= 5 * 1024 * 1024);
                
                if (isMultiple) {
                    fileUploadHandlers[storageKey].push(...validFiles);
                } else {
                    fileUploadHandlers[storageKey] = validFiles[0] || null;
                }
                
                updateFileList(storageKey, listContainer, isMultiple);
            });
        }

        function updateFileList(storageKey, listContainer, isMultiple) {
            listContainer.innerHTML = '';
            const files = isMultiple ? fileUploadHandlers[storageKey] : (fileUploadHandlers[storageKey] ? [fileUploadHandlers[storageKey]] : []);
            
            if (files.length > 0) {
                listContainer.classList.remove('hidden');
                files.forEach((file, index) => {
                    const item = createFileListItem(file, index, (idx) => {
                        if (isMultiple) {
                            fileUploadHandlers[storageKey].splice(idx, 1);
                        } else {
                            fileUploadHandlers[storageKey] = null;
                        }
                        updateFileList(storageKey, listContainer, isMultiple);
                    });
                    listContainer.appendChild(item);
                });
            } else {
                listContainer.classList.add('hidden');
            }
        }

        // Initialize file uploads when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            setupFileUpload('academicRecords', 'academicRecordsList', true);
            setupFileUpload('reportCards', 'reportCardsList', true);
            setupFileUpload('transferCert', 'transferCertList', false);
            setupFileUpload('birthCert', 'birthCertList', false);
        });

        // Update review step with uploaded files
        function updateReviewStep() {
            // Update Academic Records
            const academicRecordsContainer = document.getElementById('reviewAcademicRecords');
            if (fileUploadHandlers.academicRecords.length > 0) {
                academicRecordsContainer.innerHTML = fileUploadHandlers.academicRecords.map(file => `
                    <div class="flex items-center gap-2 text-sm text-slate-700">
                        <svg class="w-4 h-4 text-blue-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                        <span class="truncate">${file.name}</span>
                        <span class="text-xs text-slate-400">(${(file.size / 1024).toFixed(1)} KB)</span>
                    </div>
                `).join('');
            } else {
                academicRecordsContainer.innerHTML = '<span class="text-sm text-slate-400">No files uploaded</span>';
            }

            // Update Transfer Certificate
            const transferCertContainer = document.getElementById('reviewTransferCert');
            if (fileUploadHandlers.transferCert) {
                const file = fileUploadHandlers.transferCert;
                transferCertContainer.innerHTML = `
                    <div class="flex items-center gap-2 text-sm text-slate-700">
                        <svg class="w-4 h-4 text-blue-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                        <span class="truncate">${file.name}</span>
                        <span class="text-xs text-slate-400">(${(file.size / 1024).toFixed(1)} KB)</span>
                    </div>
                `;
            } else {
                transferCertContainer.innerHTML = '<span class="text-sm text-slate-400">No files uploaded</span>';
            }

            // Update Birth Certificate
            const birthCertContainer = document.getElementById('reviewBirthCert');
            if (fileUploadHandlers.birthCert) {
                const file = fileUploadHandlers.birthCert;
                birthCertContainer.innerHTML = `
                    <div class="flex items-center gap-2 text-sm text-slate-700">
                        <svg class="w-4 h-4 text-blue-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                        <span class="truncate">${file.name}</span>
                        <span class="text-xs text-slate-400">(${(file.size / 1024).toFixed(1)} KB)</span>
                    </div>
                `;
            } else {
                birthCertContainer.innerHTML = '<span class="text-sm text-slate-400">No files uploaded</span>';
            }

            // Update Report Cards (optional)
            const reportCardsSection = document.getElementById('reviewReportCardsSection');
            const reportCardsContainer = document.getElementById('reviewReportCards');
            if (fileUploadHandlers.reportCards.length > 0) {
                reportCardsSection.classList.remove('hidden');
                reportCardsContainer.innerHTML = fileUploadHandlers.reportCards.map(file => `
                    <div class="flex items-center gap-2 text-sm text-slate-700">
                        <svg class="w-4 h-4 text-blue-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                        <span class="truncate">${file.name}</span>
                        <span class="text-xs text-slate-400">(${(file.size / 1024).toFixed(1)} KB)</span>
                    </div>
                `).join('');
            } else {
                reportCardsSection.classList.add('hidden');
            }
        }

        // Submit enrollment function
        function submitEnrollment() {
            alert('Enrollment submitted successfully! This is a demo - no actual submission occurred.');
            // In a real application, this would send the form data to a server
            console.log('Enrollment data:', fileUploadHandlers);
        }

        // Minimal JavaScript - only for navigation
        function goToStep(stepNumber) {
            // Hide all steps
            for (let i = 1; i <= 6; i++) {
                const step = document.getElementById(`step-${i}`);
                if (step) {
                    step.classList.remove('active-form');
                    step.classList.add('hidden-form');
                }
            }
            
            // Show selected step
            const activeStep = document.getElementById(`step-${stepNumber}`);
            if (activeStep) {
                activeStep.classList.remove('hidden-form');
                activeStep.classList.add('active-form');
            
                        // Update review step if navigating to step 6
                        if (stepNumber === 6) {
                            updateReviewStep();
                        }
            }
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Initialize - show step 1
        document.addEventListener('DOMContentLoaded', function() {
            goToStep(1);
        });
    </script>
</body>
</html>

