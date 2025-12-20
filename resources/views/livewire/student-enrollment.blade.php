<div>
    {{-- The best athlete wants his opponent at his best. --}}

    <!--adding this to temporarily to the step-->
    <div class="debug-info" >
        Step: {{ $step }}
    </div>


    @if($step === 1)

    <!-- Step 1: Personal Info -->
    <div id="step-1">
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
                                    
                                </label>
                                
                                <div class="flex flex-col sm:flex-row gap-4 items-start">
                                    <!-- Preview Area -->
                                    <div class="flex-shrink-0">
                                        <div class="relative w-32 h-40 rounded-lg border-2 border-slate-300 bg-slate-100 overflow-hidden">
                                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">

                                                <!--check if photo is uploaded-->
                                                @if ($student_profile_picture)

                                                    <img src="{{ $student_profile_picture->temporaryUrl() }}" 
                                                        alt="Student Photo" 
                                                        class="w-full h-full object-cover" 
                                                    />
                                                    
                                                @else

                                                    <svg class="w-12 h-12 mb-2" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="12" cy="7" r="4"></circle>
                                                    </svg>
                                                    <span class="text-xs font-medium">No photo</span>

                                                @endif

                                                <!--cancel upload button-->
                                                @if ($student_profile_picture)
                                                    <button type="button" wire:click="$set('student_profile_picture', null)" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400">
                                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                @endif

                                                <!-- Loader while uploading -->
                                                <div wire:loading wire:target="student_profile_picture"
                                                    class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-70 pt-16">
                                                    <div class="flex items-center">
                                                        <svg class="animate-spin h-6 w-6 text-indigo-600"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                                                            <circle class="opacity-25" cx="25" cy="25" r="20"
                                                                    stroke="currentColor" stroke-width="5" fill="none"></circle>
                                                            <circle class="opacity-75" cx="25" cy="25" r="20"
                                                                    stroke="currentColor" stroke-width="5" fill="none"
                                                                    stroke-dasharray="31.4 31.4" stroke-linecap="round"></circle>
                                                        </svg>
                                                        <span class="ml-2 text-sm font-medium text-blue-600">Uploading...</span>
                                                    </div>
                                                </div>

                                                <!-- Error Message -->
                                                @error('student_profile_picture')
                                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                                @enderror


                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Upload Area -->
                                    <div class="flex-1 w-full">
                                        <div class="relative border-2 border-dashed border-slate-300 bg-slate-50 rounded-lg hover:border-slate-400 transition-all duration-200">
                                            <input type="file" id="photoInput" wire:model="student_profile_picture" class="hidden" accept="image/jpeg,image/jpg,image/png" />
                                            
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

                            <!-- First and Last wire:model -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        First Name
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" wire:model= "fname" placeholder="e.g. John" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />

                                     @error('fname')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                     @enderror

                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Mid name
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" wire:model = "mname" placeholder="e.g. Doe" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />

                                    @error('mname')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                     @enderror

                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Last name
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" wire:model="lname" placeholder="e.g. john" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />

                                    @error('lname')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

                            <!-- Date of Birth, Gender, Blood Group -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Date of Birth
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="date" wire:model="dob" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />

                                    @error('dob')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Gender
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <div class="relative">
                                        <select wire:model="gender" class="flex h-10 w-full appearance-none rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200">
                                            <option value="">Select gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <svg class="absolute right-3 top-3 h-4 w-4 text-slate-400 pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>

                                    @error('gender')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        School You want to enroll
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>

                                    <!--a dropdown for user to select school-->
                                    <div class="relative">
                                        <select wire:model="school_id" class="flex h-10 w-full appearance-none rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200">

                                            <option value="">Select a school</option>
                                            <!--check if the schools variable is available-->
                                            @if(isset($schools) && $schools->count() > 0)
                                                @foreach($schools as $school)
                                                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">No schools available</option>
                                            @endif

                                        </select>
                                        <svg class="absolute right-3 top-3 h-4 w-4 text-slate-400 pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>

                                    <!--error message-->
                                    @error('school_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                        <button wire:loading.remove wire:click="previousStep" disabled class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none h-10 px-4 py-2 text-sm bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500 invisible">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            Back
                        </button>

                        <!-- Loading spinner -->
                        <span wire:loading wire:target="previousStep" class="inline-flex items-center justify-center pl-4">
                            <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                            </svg>
                        </span>

                        <div class="flex items-center gap-4">
                            <button 
                                wire:click="nextStep"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 shadow-sm"
                            >

                                <!-- Normal button content -->
                                <span wire:loading.remove wire:target="nextStep" class="inline-flex items-center">
                                    Next Step
                                    <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </span>

                                <!-- Loading spinner -->
                                <span wire:loading wire:target="nextStep" class="inline-flex items-center">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                    </svg>
                                </span>

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

    @elseif ($step === 2)

    <!-- Step 2: Contact Info -->
    <div id="step-2">
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
                                    <input type="email" wire:model="email" placeholder="student@example.com" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />

                                    @error('email')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Phone Number
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="tel" wire:model="phone" placeholder="+1234567890" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />

                                    @error('phone')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

                            <!-- Street Address -->
                            <div class="space-y-6">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Street Address
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" wire:model="street" placeholder="Kinondoni" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />

                                    @error('street')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror

                                </div>

                                <!-- City, State, Postal Code -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="w-full">
                                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                            City
                                        </label>
                                        <input type="text" wire:model="city" placeholder="Dar es Salaam" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />

                                        @error('city')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="w-full">
                                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                            District
                                        </label>
                                        <input type="text" wire:model="district" placeholder="Kinondoni" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />

                                        @error('district')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="w-full">
                                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                            Ward
                                        </label>
                                        <input type="text" wire:model="ward" placeholder="Kibene" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />

                                        @error('ward')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                        <button wire:click="previousStep" wire:loading.remove class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            Back
                        </button>

                        <!-- Loading spinner -->
                        <span wire:loading wire:target="previousStep" class="inline-flex items-center justify-center pl-4">
                            <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                            </svg>
                        </span>

                        <div class="flex items-center gap-4">
                            <button 
                                wire:click="nextStep"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 shadow-sm"
                            >

                                <!-- Normal button content -->
                                <span wire:loading.remove wire:target="nextStep" class="inline-flex items-center">
                                    Next Step
                                    <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </span>

                                <!-- Loading spinner -->
                                <span wire:loading wire:target="nextStep" class="inline-flex items-center">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                    </svg>
                                </span>

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

    @elseif ($step === 3)

    <!-- Step 3: Guardian Info -->
    <div id="step-3">
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

                <!-- Guardian First, Middle, Last Name -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- First Name -->
                    <div class="w-full">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            First name <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input 
                            type="text" 
                            wire:model="firstname" 
                            placeholder="e.g. Jane"
                            class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm 
                                placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 
                                focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200"
                        />
                        @error('firstname')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Middle Name -->
                    <div class="w-full">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Middle name <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input 
                            type="text" 
                            wire:model="middlename" 
                            placeholder="e.g. Ann"
                            class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm 
                                placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 
                                focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200"
                        />
                        @error('middlename')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="w-full">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Last name <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input 
                            type="text" 
                            wire:model="lastname" 
                            placeholder="e.g. Doe"
                            class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm 
                                placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 
                                focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200"
                        />
                        @error('lastname')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <!-- Same as student checkbox -->
                <div class="flex items-center gap-2 pt-4">
                    <input 
                        type="checkbox" 
                        wire:model.live="sameAsStudent" 
                        id="sameAsStudent"
                        class="h-4 w-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500"
                    >
                    <label for="sameAsStudent" class="text-sm text-slate-700">
                        Same as student
                    </label>
                </div>


                <!-- Guardian Phone, Email, Relationship -->
                <div class=" grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Guardian Phone -->
                    <div class="w-full">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Guardian Phone <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input 
                            type="tel" 
                            wire:model="guardian_phone" 
                            placeholder="(555) 987-6543"
                            wire:disabled="sameAsStudent"
                            class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm 
                                placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 
                                focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200"
                        />
                        @error('guardian_phone')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Guardian Email -->
                    <div class="w-full">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Guardian Email <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input 
                            type="email" 
                            wire:model="guardian_email" 
                            wire:disabled="sameAsStudent"
                            placeholder="guardian@example.com"
                            class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm 
                                placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 
                                focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200"
                        />
                        @error('guardian_email')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Relationship -->
                    <div class="w-full">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Relationship <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <select 
                                wire:model="relationship" 
                                class="flex h-10 w-full appearance-none rounded-lg border border-slate-300 bg-white 
                                    px-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-0 
                                    focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200"
                            >
                                <option value="">Select an option</option>
                                <option value="father">Father</option>
                                <option value="mother">Mother</option>
                                <option value="guardian">Legal Guardian</option>
                                <option value="other">Other</option>
                            </select>

                            <svg class="absolute right-3 top-3 h-4 w-4 text-slate-400 pointer-events-none" 
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                stroke="currentColor" stroke-width="2">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>

                            @error('relationship')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                </div>

                    </div>
                </div>

                    <!-- Footer Actions -->
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                        <button wire:click="previousStep" wire:loading.remove class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            Back
                        </button>

                        <!-- Loading spinner -->
                        <span wire:loading wire:target="previousStep" class="inline-flex items-center justify-center pl-4">
                            <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                            </svg>
                        </span>

                        <div class="flex items-center gap-4">
                            <button 
                                wire:click="nextStep"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 shadow-sm"
                            >

                                <!-- Normal button content -->
                                <span wire:loading.remove wire:target="nextStep" class="inline-flex items-center">
                                    Next Step
                                    <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </span>

                                <!-- Loading spinner -->
                                <span wire:loading wire:target="nextStep" class="inline-flex items-center">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                    </svg>
                                </span>

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

    @elseif ($step === 4)

    <!-- Step 4: Academic Info -->
    <div id="step-4">
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
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 bg-white border-blue-600 text-blue-600 z-10">
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
                                    <input type="text" wire:model="student_enrollment_id" disabled class="flex h-10 w-full rounded-lg border border-slate-300 bg-slate-100 text-slate-500 font-mono px-3 py-2 text-sm focus:outline-none cursor-not-allowed" />
                                    <p class="mt-1.5 text-xs text-slate-500">Auto-generated unique identifier</p>
                                </div>
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Grade / Class Applying For
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <div class="relative">
                                        <select wire:model="grade_applied_for" class="flex h-10 w-full appearance-none rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200">
                                            <option value="">Select an option</option>
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

                                    @error('grade_applied_for')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

                            <!-- Previous School and Admission Date -->
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Previous School Name
                                    </label>
                                    <input type="text" wire:model="previous_school_name" placeholder="Enter previous school" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                    <p class="mt-1.5 text-xs text-slate-500">For Transfer Student, This field is required.</p>



                                    @error('previous_school_name	')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror

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
                                    <input type="text" wire:model="previous_grades" placeholder="grade or division" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                    <p class="mt-1.5 text-xs text-slate-500">Input the correct data, any mismatch will automatically be disqualified</p>

                                    @error('previous_grades')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Admission Date in Previous School
                                    </label>
                                    <input type="date" wire:model="admission_date" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-blue-500 focus:ring-blue-200 hover:border-slate-400 transition-all duration-200" />
                                    <p class="mt-1.5 text-xs text-slate-500">Student's admission date in previous school</p>

                                    @error('admission_date')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror

                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                        <button wire:click="previousStep" wire:loading.remove class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            Back
                        </button>

                        <!-- Loading spinner -->
                        <span wire:loading wire:target="previousStep" class="inline-flex items-center justify-center pl-4">
                            <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                            </svg>
                        </span>

                        <div class="flex items-center gap-4">
                            <button 
                                wire:click="nextStep"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 shadow-sm"
                            >

                                <!-- Normal button content -->
                                <span wire:loading.remove wire:target="nextStep" class="inline-flex items-center">
                                    Next Step
                                    <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </span>

                                <!-- Loading spinner -->
                                <span wire:loading wire:target="nextStep" class="inline-flex items-center">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                    </svg>
                                </span>

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

    @elseif ($step === 5)

    <!-- Step 5: Documents -->
    <div id="step-5">
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
                                        <input type="file" wire:model="academic_records" id="academicRecords" class="hidden" accept=".pdf,.jpg,.jpeg,.png"/>
                                        
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

                                    @error('academic_records')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror

                                    @if ($academic_records)
                                        <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg shadow-sm p-4">
                                            <p class="text-sm font-semibold text-blue-700 mb-3 flex items-center">
                                                <svg class="h-4 w-4 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path d="M12 4v16m8-8H4" />
                                                </svg>
                                                Selected Files
                                            </p>

                                            <ul class="space-y-2">
                                                @foreach ($academic_records as $index => $file)
                                                    <li class="flex items-center justify-between bg-white hover:bg-slate-50 transition-colors border border-slate-200 rounded-md px-3 py-2 text-sm">
                                                        <div class="flex items-center space-x-2">
                                                            <!-- Attractive file icon -->
                                                            <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                            <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 009.586 1H6z"/>
                                                            </svg>
                                                            <div class="flex flex-col">
                                                                <span class="text-slate-700 font-medium">{{ $file->getClientOriginalName() }}</span>
                                                                <span class="text-xs text-slate-500">
                                                                    {{ number_format($file->getSize() / 1024, 2) }} KB
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <!--cancel button with loader-->
                                                        <button type="button" wire:loading.remove wire:target="removefileUpload('academic_records', {{ $index }})"  wire:click="removefileUpload('academic_records', {{ $index }})"
                                                            class="inline-flex items-center justify-center rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-7 px-2 text-xs bg-orange-100 text-orange-600 border border-orange-200 hover:bg-orange-200 focus:ring-orange-300 shadow-sm">
                                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>

                                                        <!--loader for removing file-->
                                                        <div wire:loading wire:target="removefileUpload('academic_records', {{ $index }})" class="ml-2">
                                                            <svg class="animate-spin h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                                            </svg>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <!--add loader when uploading files-->
                                    <div wire:loading wire:target="academic_records"
                                        class="mt-2 inline-flex items-center text-sm text-blue-600 bg-blue-50 border border-blue-200 rounded-md px-3 py-2 shadow-sm">
                                        
                                        <!-- Spinner -->
                                        <svg class="animate-spin h-4 w-4 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                        </svg>

                                        <!-- Loading text -->
                                        <span class="font-medium">Uploading files...</span>
                                    </div>
                            
                                </div>

                                <!-- Previous Report Cards -->
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Previous Report Cards
                                    </label>
                                    
                                    <div class="relative border-2 border-dashed border-slate-300 bg-slate-50 rounded-lg hover:border-slate-400 transition-all duration-200">
                                        <input type="file" wire:model="reports_cards" id="reportCards" class="hidden" accept=".pdf,.jpg,.jpeg,.png"/>
                                        
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

                                    @error('reports_cards')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror

                                    @if ($reports_cards)
                                        <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg shadow-sm p-4">
                                            <p class="text-sm font-semibold text-blue-700 mb-3 flex items-center">
                                                <svg class="h-4 w-4 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path d="M12 4v16m8-8H4" />
                                                </svg>
                                                Selected Files
                                            </p>

                                            <ul class="space-y-2">
                                                @foreach ($reports_cards as $index => $file)
                                                    <li class="flex items-center justify-between bg-white hover:bg-slate-50 transition-colors border border-slate-200 rounded-md px-3 py-2 text-sm">
                                                        <div class="flex items-center space-x-2">
                                                            <!-- Attractive file icon -->
                                                            <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                            <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 009.586 1H6z"/>
                                                            </svg>
                                                            <div class="flex flex-col">
                                                                <span class="text-slate-700 font-medium">{{ $file->getClientOriginalName() }}</span>
                                                                <span class="text-xs text-slate-500">
                                                                    {{ number_format($file->getSize() / 1024, 2) }} KB
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <!--cancel button with loader-->
                                                        <button type="button" wire:loading.remove wire:target="removefileUpload('reports_cards', {{ $index }})"  wire:click="removefileUpload('reports_cards', {{ $index }})"
                                                            class="inline-flex items-center justify-center rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-7 px-2 text-xs bg-orange-100 text-orange-600 border border-orange-200 hover:bg-orange-200 focus:ring-orange-300 shadow-sm">
                                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>

                                                        <!--loader for removing file-->
                                                        <div wire:loading wire:target="removefileUpload('reports_cards', {{ $index }})" class="ml-2">
                                                            <svg class="animate-spin h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                                            </svg>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <!--add loader when uploading files-->
                                    <div wire:loading wire:target="reports_cards"
                                        class="mt-2 inline-flex items-center text-sm text-blue-600 bg-blue-50 border border-blue-200 rounded-md px-3 py-2 shadow-sm">
                                        
                                        <!-- Spinner -->
                                        <svg class="animate-spin h-4 w-4 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                        </svg>

                                        <!-- Loading text -->
                                        <span class="font-medium">Uploading files...</span>
                                    </div>

                                </div>

                                <!-- Transfer Certificate -->
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Transfer Certificate (TC)
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    
                                    <div class="relative border-2 border-dashed border-slate-300 bg-slate-50 rounded-lg hover:border-slate-400 transition-all duration-200">
                                        <input type="file" wire:model="transfer_certificate" id="transferCert" class="hidden" accept=".pdf,.jpg,.jpeg,.png" />
                                        
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

                                    @error('transfer_certificate')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror

                                    @if ($transfer_certificate)
                                        <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg shadow-sm p-4">
                                            <p class="text-sm font-semibold text-blue-700 mb-3 flex items-center">
                                                <svg class="h-4 w-4 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path d="M12 4v16m8-8H4" />
                                                </svg>
                                                Selected Files
                                            </p>

                                            <ul class="space-y-2">
                                                @foreach ($transfer_certificate as $index => $file)
                                                    <li class="flex items-center justify-between bg-white hover:bg-slate-50 transition-colors border border-slate-200 rounded-md px-3 py-2 text-sm">
                                                        <div class="flex items-center space-x-2">
                                                            <!-- Attractive file icon -->
                                                            <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                            <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 009.586 1H6z"/>
                                                            </svg>
                                                            <div class="flex flex-col">
                                                                <span class="text-slate-700 font-medium">{{ $file->getClientOriginalName() }}</span>
                                                                <span class="text-xs text-slate-500">
                                                                    {{ number_format($file->getSize() / 1024, 2) }} KB
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <button type="button" wire:loading.remove wire:target="removefileUpload('transfer_certificate', {{ $index }})"  wire:click="removefileUpload('transfer_certificate', {{ $index }})"
                                                            class="inline-flex items-center justify-center rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-7 px-2 text-xs bg-orange-100 text-orange-600 border border-orange-200 hover:bg-orange-200 focus:ring-orange-300 shadow-sm">
                                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>

                                                        <!--loader for removing file-->
                                                        <div wire:loading wire:target="removefileUpload('transfer_certificate', {{ $index }})" class="ml-2">
                                                            <svg class="animate-spin h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                                            </svg>
                                                        </div>


                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <!--add loader when uploading files-->
                                    <div wire:loading wire:target="transfer_certificate"
                                        class="mt-2 inline-flex items-center text-sm text-blue-600 bg-blue-50 border border-blue-200 rounded-md px-3 py-2 shadow-sm">
                                        
                                        <!-- Spinner -->
                                        <svg class="animate-spin h-4 w-4 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                        </svg>

                                        <!-- Loading text -->
                                        <span class="font-medium">Uploading files...</span>
                                    </div>

                                </div>

                                <!-- Birth Certificate -->
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Birth Certificate
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    
                                    <div class="relative border-2 border-dashed border-slate-300 bg-slate-50 rounded-lg hover:border-slate-400 transition-all duration-200">
                                        <input type="file" wire:model="birth_certificate" id="birthCert" class="hidden" accept=".pdf,.jpg,.jpeg,.png" />
                                        
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

                                    @error('birth_certificate')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror

                                    @if ($birth_certificate)
                                        <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg shadow-sm p-4">
                                            <p class="text-sm font-semibold text-blue-700 mb-3 flex items-center">
                                                <svg class="h-4 w-4 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path d="M12 4v16m8-8H4" />
                                                </svg>
                                                Selected Files
                                            </p>

                                            <ul class="space-y-2">

                                                    <li class="flex items-center justify-between bg-white hover:bg-slate-50 transition-colors border border-slate-200 rounded-md px-3 py-2 text-sm">
                                                        <div class="flex items-center space-x-2">
                                                            <!-- Attractive file icon -->
                                                            <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                            <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 009.586 1H6z"/>
                                                            </svg>
                                                            <div class="flex flex-col">
                                                                <span class="text-slate-700 font-medium">{{ $birth_certificate->getClientOriginalName() }}</span>
                                                                <span class="text-xs text-slate-500">
                                                                    {{ number_format($birth_certificate->getSize() / 1024, 2) }} KB
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <button type="button" wire:loading.remove wire:click="removeSingleFileUpload('birth_certificate')"
                                                            class="inline-flex items-center justify-center rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-7 px-2 text-xs bg-orange-100 text-orange-600 border border-orange-200 hover:bg-orange-200 focus:ring-orange-300 shadow-sm">
                                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>

                                                        <!--loader for removing file-->
                                                        <div wire:loading wire:target="removeSingleFileUpload('birth_certificate')" class="ml-2">
                                                            <svg class="animate-spin h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                                            </svg>
                                                        </div>

                                                    </li>
            
                                            </ul>
                                        </div>
                                    @endif

                                    <!--add loader when uploading files-->
                                    <div wire:loading wire:target="birth_certificate"
                                        class="mt-2 inline-flex items-center text-sm text-blue-600 bg-blue-50 border border-blue-200 rounded-md px-3 py-2 shadow-sm">
                                        
                                        <!-- Spinner -->
                                        <svg class="animate-spin h-4 w-4 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                        </svg>

                                        <!-- Loading text -->
                                        <span class="font-medium">Uploading files...</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                        <button wire:click="previousStep" wire:loading.remove class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            Back
                        </button>

                        <!-- Loading spinner -->
                        <span wire:loading wire:target="previousStep" class="inline-flex items-center justify-center pl-4">
                            <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                            </svg>
                        </span>

                        <div class="flex items-center gap-4">
                            <button 
                                wire:click="nextStep"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 shadow-sm"
                            >

                                <!-- Normal button content -->
                                <span wire:loading.remove wire:target="nextStep" class="inline-flex items-center">
                                    Next Step
                                    <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </span>

                                <!-- Loading spinner -->
                                <span wire:loading wire:target="nextStep" class="inline-flex items-center">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                    </svg>
                                </span>

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

    @elseif ($step === 6)

    <!-- Step 6: Review & Submit -->
    <div id="step-6">
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
                                    <button class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-8 px-3 text-xs bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
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
                                                <!--check if photo is uploaded-->
                                                @if ($student_profile_picture)

                                                    <img src="{{ $student_profile_picture->temporaryUrl() }}" 
                                                        alt="Student Photo" 
                                                        class="w-full h-full object-cover" 
                                                    />
                                                    
                                                @else

                                                    <svg class="w-12 h-12 mb-2" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="12" cy="7" r="4"></circle>
                                                    </svg>
                                                    <span class="text-xs font-medium">No photo</span>

                                                @endif

                                                <!--cancel upload button-->
                                                @if ($student_profile_picture)
                                                    <button type="button" wire:click="$set('student_profile_picture', null)" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400">
                                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                @endif

                                                <!-- Loader while uploading -->
                                                <div wire:loading wire:target="student_profile_picture"
                                                    class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-70 pt-16">
                                                    <div class="flex items-center">
                                                        <svg class="animate-spin h-6 w-6 text-indigo-600"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                                                            <circle class="opacity-25" cx="25" cy="25" r="20"
                                                                    stroke="currentColor" stroke-width="5" fill="none"></circle>
                                                            <circle class="opacity-75" cx="25" cy="25" r="20"
                                                                    stroke="currentColor" stroke-width="5" fill="none"
                                                                    stroke-dasharray="31.4 31.4" stroke-linecap="round"></circle>
                                                        </svg>
                                                        <span class="ml-2 text-sm font-medium text-blue-600">Uploading...</span>
                                                    </div>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="flex flex-col">
                                                <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Full Name</span>

                                                <!--check if the variable exists-->
                                                @if (!empty($fname) && !empty($mname) && !empty($lname))
                                                    <span class="text-sm text-slate-900 font-medium">{{ $fname }} {{ $mname }} {{ $lname }}</span>
                                                @else
                                                    <span class="text-sm text-slate-400 italic">All Names Not Provided</span> 
                                                @endif
                                                
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Date of Birth</span>
                                                <!--check if the variable exists-->
                                                @if (!empty($dob))
                                                    <span class="text-sm text-slate-900 font-medium">{{ $dob }}</span>
                                                @else
                                                    <span class="text-sm text-slate-400 italic">Date Not Provided</span>
                                                @endif
                                                
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Gender</span>
                                                <!--check if the variable exists-->
                                                @if (!empty($gender))
                                                    <span class="text-sm text-slate-900 font-medium">{{ $gender }}</span>
                                                @else
                                                    <span class="text-sm text-slate-400 italic">Gender Not Provided</span> 
                                                @endif

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
                                    <button class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-8 px-3 text-xs bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
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

                                        <!--check if the email variable exists-->
                                        @if (!empty($email))
                                            <span class="text-sm text-slate-900 font-medium">student@example.com</span>
                                        @else
                                            <span class="text-sm text-slate-400 italic">Email Not Provided</span>
                                        @endif
                                        
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Phone</span>

                                        <!--check if the phone variable exists-->
                                        @if (!empty($phone))
                                            <span class="text-sm text-slate-900 font-medium">{{ $phone }}</span>
                                        @else
                                            <span class="text-sm text-slate-400 italic">Phone Not Provided</span>
                                        @endif

                                    </div>
                                    <div class="flex flex-col col-span-2">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Address</span>

                                        <!--check if the address variable exists-->
                                        @if (!empty($street))
                                            <span class="text-sm text-slate-900 font-medium">{{ $street }}</span>
                                        @else
                                            <span class="text-sm text-slate-400 italic">Address Not Provided</span>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <!-- Guardian Information Section -->
                            <div class="bg-white rounded-lg border border-slate-200 overflow-hidden mb-6">
                                <div class="flex items-center justify-between px-6 py-4 bg-slate-50 border-b border-slate-200">
                                    <h3 class="font-semibold text-slate-800">Guardian Information</h3>
                                    <button class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-8 px-3 text-xs bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
                                        <svg class="w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        Edit
                                    </button>
                                </div>
                                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Guardian Full Name</span>

                                        <!--check if the guardian_name variable exists-->
                                        @if (!empty($firstname) && !empty($middlename) && !empty($lastname))
                                            <span class="text-sm text-slate-900 font-medium">{{ $firstname }} {{ $middlename }} {{ $lastname }}</span>
                                        @else
                                            <span class="text-sm text-slate-400 italic">Name Not Provided</span>
                                        @endif

                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Relationship</span>

                                        <!--check if the guardian_relationship variable exists-->
                                        @if (!empty($relationship))
                                            <span class="text-sm text-slate-900 font-medium">{{ $relationship }}</span>
                                        @else
                                            <span class="text-sm text-slate-400 italic">Relationship Not Provided</span>
                                        @endif

                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Phone</span>

                                        <!--check if the guardian_phone variable exists-->
                                        @if (!empty($guardian_phone))
                                            <span class="text-sm text-slate-900 font-medium">{{ $guardian_phone }}</span>
                                        @else
                                            <span class="text-sm text-slate-400 italic">Phone Not Provided</span>
                                        @endif

                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Email</span>

                                        <!--check if the guardian_email variable exists-->
                                        @if (!empty($guardian_email))
                                            <span class="text-sm text-slate-900 font-medium">{{ $guardian_email }}</span>
                                        @else
                                            <span class="text-sm text-slate-400 italic">Email Not Provided</span>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <!-- Academic Information Section -->
                            <div class="bg-white rounded-lg border border-slate-200 overflow-hidden mb-6">
                                <div class="flex items-center justify-between px-6 py-4 bg-slate-50 border-b border-slate-200">
                                    <h3 class="font-semibold text-slate-800">Academic Information</h3>
                                    <button class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-8 px-3 text-xs bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
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

                                        <!--check if the student_id variable exists-->
                                        @if (!empty($student_enrollment_id))
                                            <span class="text-sm text-slate-900 font-medium">{{ $student_enrollment_id }}</span>
                                        @else
                                            <span class="text-sm text-slate-400 italic">Not Set, Please Re-Apply the Form Again</span>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Grade Applied For</span>

                                        <!--check if the grade_applied variable exists-->
                                        @if (!empty($grade_applied_for))
                                            <span class="text-sm text-slate-900 font-medium">{{ $grade_applied_for }}</span>
                                        @else
                                            <span class="text-sm text-slate-400 italic">Grade Not Provided</span>
                                        @endif

                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Previous School</span>

                                        <!--check if the previous_school variable exists-->
                                        @if (!empty($previous_school_name))
                                            <span class="text-sm text-slate-900 font-medium">{{ $previous_school_name }}</span>
                                        @else
                                            <span class="text-sm text-slate-400 italic">School Not Provided</span>
                                        @endif

                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Admission Date</span>

                                        <!--check if the admission_date variable exists-->
                                        @if (!empty($admission_date))
                                            <span class="text-sm text-slate-900 font-medium">{{ $admission_date }}</span>
                                        @else
                                            <span class="text-sm text-slate-400 italic">Date Not Provided</span>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <!-- Uploaded Documents Section -->
                            <div class="bg-white rounded-lg border border-slate-200 overflow-hidden mb-6">
                                <div class="flex items-center justify-between px-6 py-4 bg-slate-50 border-b border-slate-200">
                                    <h3 class="font-semibold text-slate-800">Uploaded Documents</h3>
                                    <button class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-8 px-3 text-xs bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">
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
                                            <!--check if there are uploaded academic records-->
                                            @if (!empty($academic_records) && is_array($academic_records))
                                                <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg shadow-sm p-4">
                                                    <p class="text-sm font-semibold text-blue-700 mb-3 flex items-center">
                                                        <svg class="h-4 w-4 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path d="M12 4v16m8-8H4" />
                                                        </svg>
                                                        Academic Record Files
                                                    </p>

                                                    <ul class="space-y-2">
                                                        @foreach ($academic_records as $index => $record)
                                                            <li class="flex items-center justify-between bg-white hover:bg-slate-50 transition-colors border border-slate-200 rounded-md px-3 py-2 text-sm">
                                                                <div class="flex items-center space-x-2">
                                                                    <!-- File icon -->
                                                                    <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                        viewBox="0 0 20 20">
                                                                        <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 009.586 1H6z"/>
                                                                    </svg>
                                                                    <div class="flex flex-col">
                                                                        <span class="text-slate-700 font-medium">{{ $record->getClientOriginalName() }}</span>
                                                                        <span class="text-xs text-slate-500">
                                                                            {{ number_format($record->getSize() / 1024, 2) }} KB
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <!-- Cancel button -->
                                                                <button type="button"
                                                                        wire:click="removeAcademicRecord({{ $index }})"
                                                                        wire:loading.remove
                                                                        wire:target="removeAcademicRecord"
                                                                        class="inline-flex items-center justify-center rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-7 px-2 text-xs bg-orange-100 text-orange-600 border border-orange-200 hover:bg-orange-200 focus:ring-orange-300 shadow-sm">
                                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                    </svg>
                                                                </button>

                                                                <!-- Loader -->
                                                                <div wire:loading wire:target="removeAcademicRecord" class="ml-2">
                                                                    <svg class="animate-spin h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24">
                                                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                                                                stroke="currentColor" stroke-width="4"></circle>
                                                                        <path class="opacity-75" fill="currentColor"
                                                                            d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                                                    </svg>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @elseif(!empty($academic_records))
                                                <!-- Single file case styled the same way -->
                                                <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg shadow-sm p-4">
                                                    <p class="text-sm font-semibold text-blue-700 mb-3 flex items-center">
                                                        <svg class="h-4 w-4 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path d="M12 4v16m8-8H4" />
                                                        </svg>
                                                        Academic Record File
                                                    </p>

                                                    <ul>
                                                        <li class="flex items-center justify-between bg-white hover:bg-slate-50 transition-colors border border-slate-200 rounded-md px-3 py-2 text-sm">
                                                            <div class="flex items-center space-x-2">
                                                                <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 009.586 1H6z"/>
                                                                </svg>
                                                                <div class="flex flex-col">
                                                                    <span class="text-slate-700 font-medium">{{ $academic_records->getClientOriginalName() }}</span>
                                                                    <span class="text-xs text-slate-500">
                                                                        {{ number_format($academic_records->getSize() / 1024, 2) }} KB
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <button type="button"
                                                                    wire:click="removeAcademicRecord(0)"
                                                                    wire:loading.remove
                                                                    wire:target="removeAcademicRecord"
                                                                    class="inline-flex items-center justify-center rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-7 px-2 text-xs bg-orange-100 text-orange-600 border border-orange-200 hover:bg-orange-200 focus:ring-orange-300 shadow-sm">
                                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                </svg>
                                                            </button>

                                                            <div wire:loading wire:target="removeAcademicRecord" class="ml-2">
                                                                <svg class="animate-spin h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24">
                                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                                            stroke="currentColor" stroke-width="4"></circle>
                                                                    <path class="opacity-75" fill="currentColor"
                                                                        d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                                                </svg>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @else
                                                <span class="text-sm text-slate-400">No files uploaded</span>
                                            @endif
                                            
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Transfer Certificate</p>
                                        <div id="reviewTransferCert" class="space-y-2">

                                            <!--check if there are uploaded transfer certificate-->
                                           @if (!empty($transfer_certificate) && is_array($transfer_certificate))
                                            <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg shadow-sm p-4">
                                                <p class="text-sm font-semibold text-blue-700 mb-3 flex items-center">
                                                    <svg class="h-4 w-4 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    Selected Files
                                                </p>

                                                <ul class="space-y-2">
                                                    @foreach ($transfer_certificate as $index => $cert)
                                                        <li class="flex items-center justify-between bg-white hover:bg-slate-50 transition-colors border border-slate-200 rounded-md px-3 py-2 text-sm">
                                                            <div class="flex items-center space-x-2">
                                                                <!-- File icon -->
                                                                <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 009.586 1H6z"/>
                                                                </svg>
                                                                <div class="flex flex-col">
                                                                    <span class="text-slate-700 font-medium">{{ $cert->getClientOriginalName() }}</span>
                                                                    <span class="text-xs text-slate-500">
                                                                        {{ number_format($cert->getSize() / 1024, 2) }} KB
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <!-- Cancel button -->
                                                            <button type="button"
                                                                    wire:click="removeTransferCertificate({{ $index }})"
                                                                    wire:loading.remove
                                                                    wire:target="removeTransferCertificate"
                                                                    class="inline-flex items-center justify-center rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-7 px-2 text-xs bg-orange-100 text-orange-600 border border-orange-200 hover:bg-orange-200 focus:ring-orange-300 shadow-sm">
                                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                </svg>
                                                            </button>

                                                            <!-- Loader -->
                                                            <div wire:loading wire:target="removeTransferCertificate" class="ml-2">
                                                                <svg class="animate-spin h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24">
                                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                                            stroke="currentColor" stroke-width="4"></circle>
                                                                    <path class="opacity-75" fill="currentColor"
                                                                        d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                                                </svg>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @elseif(!empty($transfer_certificate))
                                                <!-- Single file case styled the same way -->
                                                <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg shadow-sm p-4">
                                                    <p class="text-sm font-semibold text-blue-700 mb-3 flex items-center">
                                                        <svg class="h-4 w-4 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path d="M12 4v16m8-8H4" />
                                                        </svg>
                                                        Selected File
                                                    </p>

                                                    <ul>
                                                        <li class="flex items-center justify-between bg-white hover:bg-slate-50 transition-colors border border-slate-200 rounded-md px-3 py-2 text-sm">
                                                            <div class="flex items-center space-x-2">
                                                                <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 009.586 1H6z"/>
                                                                </svg>
                                                                <div class="flex flex-col">
                                                                    <span class="text-slate-700 font-medium">{{ $transfer_certificate->getClientOriginalName() }}</span>
                                                                    <span class="text-xs text-slate-500">
                                                                        {{ number_format($transfer_certificate->getSize() / 1024, 2) }} KB
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <button type="button"
                                                                    wire:click="removeTransferCertificate(0)"
                                                                    wire:loading.remove
                                                                    wire:target="removeTransferCertificate"
                                                                    class="inline-flex items-center justify-center rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-7 px-2 text-xs bg-orange-100 text-orange-600 border border-orange-200 hover:bg-orange-200 focus:ring-orange-300 shadow-sm">
                                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                </svg>
                                                            </button>

                                                            <div wire:loading wire:target="removeTransferCertificate" class="ml-2">
                                                                <svg class="animate-spin h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24">
                                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                                            stroke="currentColor" stroke-width="4"></circle>
                                                                    <path class="opacity-75" fill="currentColor"
                                                                        d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                                                </svg>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @else
                                                <span class="text-sm text-slate-400">No files uploaded</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Birth Certificate</p>
                                        <div id="reviewBirthCert" class="space-y-2">

                                            <!--check if there are uploaded birth certificate-->
                                            @if (!empty($birth_certificate) && is_array($birth_certificate))
                                                <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg shadow-sm p-4">
                                                    <p class="text-sm font-semibold text-blue-700 mb-3 flex items-center">
                                                        <svg class="h-4 w-4 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path d="M12 4v16m8-8H4" />
                                                        </svg>
                                                        Birth Certificate Files
                                                    </p>

                                                    <ul class="space-y-2">
                                                        @foreach ($birth_certificate as $index => $birthCert)
                                                            <li class="flex items-center justify-between bg-white hover:bg-slate-50 transition-colors border border-slate-200 rounded-md px-3 py-2 text-sm">
                                                                <div class="flex items-center space-x-2">
                                                                    <!-- File icon -->
                                                                    <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                        viewBox="0 0 20 20">
                                                                        <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 009.586 1H6z"/>
                                                                    </svg>
                                                                    <div class="flex flex-col">
                                                                        <span class="text-slate-700 font-medium">{{ $birthCert->getClientOriginalName() }}</span>
                                                                        <span class="text-xs text-slate-500">
                                                                            {{ number_format($birthCert->getSize() / 1024, 2) }} KB
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <!-- Cancel button -->
                                                                <button type="button"
                                                                        wire:click="removeBirthCertificate({{ $index }})"
                                                                        wire:loading.remove
                                                                        wire:target="removeBirthCertificate"
                                                                        class="inline-flex items-center justify-center rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-7 px-2 text-xs bg-orange-100 text-orange-600 border border-orange-200 hover:bg-orange-200 focus:ring-orange-300 shadow-sm">
                                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                    </svg>
                                                                </button>

                                                                <!-- Loader -->
                                                                <div wire:loading wire:target="removeBirthCertificate" class="ml-2">
                                                                    <svg class="animate-spin h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24">
                                                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                                                                stroke="currentColor" stroke-width="4"></circle>
                                                                        <path class="opacity-75" fill="currentColor"
                                                                            d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                                                    </svg>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @elseif(!empty($birth_certificate))
                                                <!-- Single file case styled the same way -->
                                                <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg shadow-sm p-4">
                                                    <p class="text-sm font-semibold text-blue-700 mb-3 flex items-center">
                                                        <svg class="h-4 w-4 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path d="M12 4v16m8-8H4" />
                                                        </svg>
                                                        Birth Certificate File
                                                    </p>

                                                    <ul>
                                                        <li class="flex items-center justify-between bg-white hover:bg-slate-50 transition-colors border border-slate-200 rounded-md px-3 py-2 text-sm">
                                                            <div class="flex items-center space-x-2">
                                                                <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 009.586 1H6z"/>
                                                                </svg>
                                                                <div class="flex flex-col">
                                                                    <span class="text-slate-700 font-medium">{{ $birth_certificate->getClientOriginalName() }}</span>
                                                                    <span class="text-xs text-slate-500">
                                                                        {{ number_format($birth_certificate->getSize() / 1024, 2) }} KB
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <button type="button"
                                                                    wire:click="removeBirthCertificate(0)"
                                                                    wire:loading.remove
                                                                    wire:target="removeBirthCertificate"
                                                                    class="inline-flex items-center justify-center rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-7 px-2 text-xs bg-orange-100 text-orange-600 border border-orange-200 hover:bg-orange-200 focus:ring-orange-300 shadow-sm">
                                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                </svg>
                                                            </button>

                                                            <div wire:loading wire:target="removeBirthCertificate" class="ml-2">
                                                                <svg class="animate-spin h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24">
                                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                                            stroke="currentColor" stroke-width="4"></circle>
                                                                    <path class="opacity-75" fill="currentColor"
                                                                        d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                                                </svg>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @else
                                                <span class="text-sm text-slate-400">No files uploaded</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="reviewReportCardsSection" class="">
                                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Previous Report Cards</p>
                                        <div id="reviewReportCards" class="space-y-2">
                                            <!--check if there are uploaded report cards-->
                                           @if (!empty($reports_cards) && is_array($reports_cards))
                                                <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg shadow-sm p-4">
                                                    <p class="text-sm font-semibold text-blue-700 mb-3 flex items-center">
                                                        <svg class="h-4 w-4 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path d="M12 4v16m8-8H4" />
                                                        </svg>
                                                        Report Card Files
                                                    </p>

                                                    <ul class="space-y-2">
                                                        @foreach ($reports_cards as $index => $reportCard)
                                                            <li class="flex items-center justify-between bg-white hover:bg-slate-50 transition-colors border border-slate-200 rounded-md px-3 py-2 text-sm">
                                                                <div class="flex items-center space-x-2">
                                                                    <!-- File icon -->
                                                                    <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                        viewBox="0 0 20 20">
                                                                        <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 009.586 1H6z"/>
                                                                    </svg>
                                                                    <div class="flex flex-col">
                                                                        <span class="text-slate-700 font-medium">{{ $reportCard->getClientOriginalName() }}</span>
                                                                        <span class="text-xs text-slate-500">
                                                                            {{ number_format($reportCard->getSize() / 1024, 2) }} KB
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <!-- Cancel button -->
                                                                <button type="button"
                                                                        wire:click="removeReportCard({{ $index }})"
                                                                        wire:loading.remove
                                                                        wire:target="removeReportCard"
                                                                        class="inline-flex items-center justify-center rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-7 px-2 text-xs bg-orange-100 text-orange-600 border border-orange-200 hover:bg-orange-200 focus:ring-orange-300 shadow-sm">
                                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                    </svg>
                                                                </button>

                                                                <!-- Loader -->
                                                                <div wire:loading wire:target="removeReportCard" class="ml-2">
                                                                    <svg class="animate-spin h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24">
                                                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                                                                stroke="currentColor" stroke-width="4"></circle>
                                                                        <path class="opacity-75" fill="currentColor"
                                                                            d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                                                    </svg>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @elseif(!empty($reports_cards))
                                                <!-- Single file case styled the same way -->
                                                <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg shadow-sm p-4">
                                                    <p class="text-sm font-semibold text-blue-700 mb-3 flex items-center">
                                                        <svg class="h-4 w-4 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path d="M12 4v16m8-8H4" />
                                                        </svg>
                                                        Report Card File
                                                    </p>

                                                    <ul>
                                                        <li class="flex items-center justify-between bg-white hover:bg-slate-50 transition-colors border border-slate-200 rounded-md px-3 py-2 text-sm">
                                                            <div class="flex items-center space-x-2">
                                                                <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 009.586 1H6z"/>
                                                                </svg>
                                                                <div class="flex flex-col">
                                                                    <span class="text-slate-700 font-medium">{{ $report_cards->getClientOriginalName() }}</span>
                                                                    <span class="text-xs text-slate-500">
                                                                        {{ number_format($report_cards->getSize() / 1024, 2) }} KB
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <button type="button"
                                                                    wire:click="removeReportCard(0)"
                                                                    wire:loading.remove
                                                                    wire:target="removeReportCard"
                                                                    class="inline-flex items-center justify-center rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-7 px-2 text-xs bg-orange-100 text-orange-600 border border-orange-200 hover:bg-orange-200 focus:ring-orange-300 shadow-sm">
                                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                </svg>
                                                            </button>

                                                            <div wire:loading wire:target="removeReportCard" class="ml-2">
                                                                <svg class="animate-spin h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24">
                                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                                            stroke="currentColor" stroke-width="4"></circle>
                                                                    <path class="opacity-75" fill="currentColor"
                                                                        d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                                                                </svg>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @else
                                                <span class="text-sm text-slate-400">No files uploaded</span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                        <button wire:click="previousStep" wire:loading.remove class="inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 h-10 px-4 py-2 text-sm bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-500">

                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            Back

                        </button>

                        <!-- Loading spinner -->
                        <span wire:loading wire:target="previousStep" class="inline-flex items-center justify-center pl-4">
                            <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                            </svg>
                        </span>

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

    @endif

</div>
