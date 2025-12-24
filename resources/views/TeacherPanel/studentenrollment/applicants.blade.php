<x-Teacher-sidebar>

    <style>
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>
    
    <!-- Fallback university color utilities -->
    <style>
        :root{
            --univ-burgundy: #5B4BFF;
            --univ-gold: #B8860B;
            --univ-cream: #FDFBF7;
            --univ-gray: #F4F4F4;
            --univ-text: #2D2D2D;
        }
        .bg-university-cream{ background-color:var(--univ-cream) !important; }
        .text-university-text{ color:var(--univ-text) !important; }
        .bg-university-burgundy{ background-color:var(--univ-burgundy) !important; }
        .text-university-burgundy{ color:var(--univ-burgundy) !important; }
        .bg-university-gray{ background-color:var(--univ-gray) !important; }
        .border-university-gold{ border-color:var(--univ-gold) !important; }
        .bg-university-gold\/10{ background-color: rgba(184,134,11,0.10) !important; }
        .bg-university-burgundy\/10{ background-color: rgba(91,75,255,0.10) !important; }
        .bg-university-burgundy\/50{ background-color: rgba(91,75,255,0.50) !important; }
        .font-sans { font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial !important; }
        .bg-gray-50{ background-color:#F9FAFB !important; }
    </style>

    <!-- Main Content -->
        <main class="flex-1 w-full overflow-y-auto h-screen md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
            <div class="w-full max-w-7xl mx-auto">
                <div class="space-y-6">
                    <!-- Page Header (styled banner from dashboard) -->
                    <div class="mb-8">
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex items-center justify-between gap-4 border-l-4 border-university-burgundy">

                            <!--toogle sidebar button-->
                            <button id="sidebarToggle" aria-label="Open sidebar" class="md:hidden p-2 bg-indigo-600 text-white rounded"> 
                            <i class="bi bi-list"></i> 
                            </button>

                            <div class="flex items-center gap-3">
                                
                                <div>
                                    <h1 class="text-2xl font-serif font-bold text-university-burgundy">Student Enrollments</h1>
                                    <p class="text-sm text-gray-500 mt-1">Manage and process student enrollment applications.</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="text-right hidden sm:block">
                                    <p class="text-xs text-gray-500 uppercase">Today</p>
                                    <p class="text-sm font-medium text-gray-600">Dec 22, 2025</p>
                                </div>
                                <button class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-university-burgundy text-white font-medium shadow-sm">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 20c0-3.31 2.69-6 6-6s6 2.69 6 6" />
                                    </svg>
                                    Profile
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Applications Table -->
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Pending Enrollments</h3>
                                <p class="text-sm text-gray-500 mt-1">New student enrollment requests awaiting approval</p>
                            </div>
                            <span id="pending-count" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">3</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-gray-50 text-gray-600 font-medium border-b border-gray-200">
                                    <tr>
                                        <th class="px-6 py-4">Student Name</th>
                                        <th class="px-6 py-4">Program</th>
                                        <th class="px-6 py-4">Applied Date</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <!-- Pending Application 1 -->

                                    <!--check if there are pending applicants from the controller-->
                                    @if(isset($pendingapplicants) && count($pendingapplicants) > 0)
                                        @foreach($pendingapplicants as $index => $applicant)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4">
                                                    <div>
                                                        <div class="font-medium text-gray-900">{{ $applicant->studentEnrollment->fname }} {{ $applicant->studentEnrollment->lname }}</div>
                                                        <div class="text-gray-500 text-xs">{{ $applicant->studentEnrollment->parentEnrollment->email }}</div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-gray-600">{{ $applicant->grade_applied_for }}</td>
                                                <td class="px-6 py-4 text-gray-600">{{ $applicant->created_at->format('F d, Y') }}</td>
                                                <td class="px-6 py-4">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        pending
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    <div class="flex items-center justify-end gap-2">
                                                        <!--open the modal button -->
                                                        <button onclick="openModal({{ $index }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="View Details">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                            </svg>
                                                        </button>


                                                        <a href="#" class="p-1.5 text-green-600 hover:bg-green-50 rounded-md transition-colors" title="Approve Enrollment">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                        </a>

                                                        <a href="#" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Reject Enrollment">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                        </a>

                                                        <a href="#" class="p-1.5 text-gray-400 hover:text-gray-600 rounded-md">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                                            </svg>
                                                        </a>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No pending enrollment applications.</td>
                                        </tr>
                                    @endif

                                    {{-- --- IGNORE ---
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div>
                                                <div class="font-medium text-gray-900">Sarah Connor</div>
                                                <div class="text-gray-500 text-xs">sarah@example.com</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">Computer Science</td>
                                        <td class="px-6 py-4 text-gray-600">2023-10-24</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                pending
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <button onclick="openModal()" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="View Details">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </button>
                                                <a href="#" class="p-1.5 text-green-600 hover:bg-green-50 rounded-md transition-colors" title="Approve Enrollment">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </a>
                                                <a href="#" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Reject Enrollment">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </a>
                                                <a href="#" class="p-1.5 text-gray-400 hover:text-gray-600 rounded-md">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Pending Application 2 -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div>
                                                <div class="font-medium text-gray-900">Emily Davis</div>
                                                <div class="text-gray-500 text-xs">emily@example.com</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">Liberal Arts</td>
                                        <td class="px-6 py-4 text-gray-600">2023-10-22</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                pending
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <button onclick="openModal()" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="View Details">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </button>
                                                <a href="#" class="p-1.5 text-green-600 hover:bg-green-50 rounded-md transition-colors" title="Approve Enrollment">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </a>
                                                <a href="#" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Reject Enrollment">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </a>
                                                <a href="#" class="p-1.5 text-gray-400 hover:text-gray-600 rounded-md">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Pending Application 3 -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div>
                                                <div class="font-medium text-gray-900">Lisa Anderson</div>
                                                <div class="text-gray-500 text-xs">lisa@example.com</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">Communications</td>
                                        <td class="px-6 py-4 text-gray-600">2023-10-20</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                pending
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <button onclick="openModal()" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="View Details">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </button>
                                                <a href="#" class="p-1.5 text-green-600 hover:bg-green-50 rounded-md transition-colors" title="Approve Enrollment">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </button>
                                                <a href="#" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Reject Enrollment">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </a>
                                                <a href="#" class="p-1.5 text-gray-400 hover:text-gray-600 rounded-md">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>  --}}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Link to Processed Enrollments -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-blue-900">Processed Enrollments</h3>
                            <p class="text-sm text-blue-700 mt-1">View approved and rejected student enrollments below</p>
                        </div>
                    </div>

                    <!-- Approved Enrollments Table -->
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Approved Students</h3>
                                <p class="text-sm text-gray-500 mt-1">Successfully approved student enrollments</p>
                            </div>
                            <span id="approved-count" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">2</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-gray-50 text-gray-600 font-medium border-b border-gray-200">
                                    <tr>
                                        <th class="px-6 py-4">Student Name</th>
                                        <th class="px-6 py-4">Program</th>
                                        <th class="px-6 py-4">Applied Date</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <!-- Approved Application 1 -->

                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div>
                                                <div class="font-medium text-gray-900">John Smith</div>
                                                <div class="text-gray-500 text-xs">john@example.com</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">Business Administration</td>
                                        <td class="px-6 py-4 text-gray-600">2023-10-23</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                approved
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="#" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="View Details">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </a>
                                                <a href="#" class="p-1.5 text-gray-400 hover:text-gray-600 rounded-md">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Approved Application 2 -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div>
                                                <div class="font-medium text-gray-900">David Wilson</div>
                                                <div class="text-gray-500 text-xs">david@example.com</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">Pre-Med</td>
                                        <td class="px-6 py-4 text-gray-600">2023-10-21</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                approved
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="#" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="View Details">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </a>
                                                <a href="#" class="p-1.5 text-gray-400 hover:text-gray-600 rounded-md">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Rejected Enrollments Table -->
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Rejected Students</h3>
                                <p class="text-sm text-gray-500 mt-1">Rejected student enrollment applications</p>
                            </div>
                            <span id="rejected-count" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">1</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-gray-50 text-gray-600 font-medium border-b border-gray-200">
                                    <tr>
                                        <th class="px-6 py-4">Student Name</th>
                                        <th class="px-6 py-4">Program</th>
                                        <th class="px-6 py-4">Applied Date</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <!-- Rejected Application 1 -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div>
                                                <div class="font-medium text-gray-900">Michael Chen</div>
                                                <div class="text-gray-500 text-xs">michael@example.com</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">Engineering</td>
                                        <td class="px-6 py-4 text-gray-600">2023-10-23</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                rejected
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="#" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="View Details">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </a>
                                                <a href="#" class="p-1.5 text-gray-400 hover:text-gray-600 rounded-md">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    <!-- Modal for Viewing Student Details -->
    <div id="studentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden m-4">
            <!-- Modal Header -->
            <div class="p-6 border-b-2 border-university-burgundy flex items-center justify-between bg-gradient-to-r from-university-burgundy/5 to-transparent">
                <div>
                    <h2 class="text-2xl font-bold text-university-burgundy">Student Enrollment Details</h2>
                    <p class="text-sm text-gray-500 mt-1">Review student information and enrollment documents</p>
                </div>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 overflow-y-auto max-h-[calc(90vh-200px)]">
                <!-- Student Information -->
                <div class="mb-8 pb-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-university-burgundy mb-4">Student Information</h3>

                    <!--display student details in a grid -->

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Full Name</label>
                            <p class="text-gray-900 font-semibold text-lg">{{ $pendingapplicants[$index]->studentEnrollment->fname }} {{ $pendingapplicants[$index]->studentEnrollment->mname }} {{ $pendingapplicants[$index]->studentEnrollment->lname }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Email Address</label>
                            <p class="text-gray-900">{{ $pendingapplicants[$index]->studentEnrollment->parentEnrollment->email }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Phone Number</label>
                            <p class="text-gray-900">{{ $pendingapplicants[$index]->studentEnrollment->parentEnrollment->phone }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Program Applied</label>
                            <p class="text-gray-900 font-semibold">{{ $pendingapplicants[$index]->grade_applied_for }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Application Date</label>
                            <p class="text-gray-900">{{ $pendingapplicants[$index]->created_at->format('F d, Y') }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Enrollment Status</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">{{ ucfirst($pendingapplicants[$index]->status) }}</span>
                        </div>

                        {{-- IGNORE
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">GPA</label>
                            <p class="text-gray-900 font-semibold text-lg">3.85</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Test Score</label>
                            <p class="text-gray-900 font-semibold text-lg">1520 (SAT)</p>
                        </div>
                         --}}
                    </div>
                </div>

                <!-- Previous School Information -->
                <div class="mb-8 pb-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-university-burgundy mb-4">Previous School</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">School Name</label>
                        <p class="text-gray-900 font-semibold text-lg"> {{ $pendingapplicants[$index]->previous_school_name }} </p>
                    </div>
                </div>

                {{--  
                <!-- Statement of Purpose -->
                <div class="mb-8 pb-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-university-burgundy mb-3">Statement of Purpose</h3>
                    <div class="bg-university-cream rounded-lg p-6 border-l-4 border-university-burgundy">
                        <p class="text-gray-700 text-sm leading-relaxed">
                            I have always been passionate about computer science and technology. Throughout my high school years, I have developed a strong foundation in programming and mathematics, which has prepared me well for university-level coursework.<br><br>
                            I am particularly interested in pursuing Computer Science at your institution because of its excellent faculty, cutting-edge curriculum, and strong industry connections. I believe that the comprehensive program will equip me with the knowledge and skills necessary to excel in this rapidly evolving field.<br><br>
                            My goal is to become a software engineer and contribute to innovative projects that solve real-world problems. I am committed to academic excellence and look forward to engaging with the vibrant community at your university.
                        </p>
                    </div>
                </div>
                --}}

                <!-- Attached Documents -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-university-burgundy mb-4">Attached Documents</h3>
                    @php
                        $academicRecords = $pendingapplicants[$index]->academic_records ? json_decode($pendingapplicants[$index]->academic_records, true) : [];
                        $transferCertificates = $pendingapplicants[$index]->transfer_certificate ? json_decode($pendingapplicants[$index]->transfer_certificate, true) : [];
                        $birthCertificate = $pendingapplicants[$index]->birth_certificate;
                        $reportCards = $pendingapplicants[$index]->reports_card ? json_decode($pendingapplicants[$index]->reports_card, true) : [];
                    @endphp
                    <div class="space-y-3">
                        <!-- Academic Records -->
                        @foreach($academicRecords as $recordPath)
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-white rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-red-100 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Academic Records</p>
                                    <p class="text-xs text-gray-500">{{ basename($recordPath) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button onclick="openDocumentViewer('{{ asset('storage/' . $recordPath) }}', '{{ basename($recordPath) }}')" class="px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition-colors">View</button>
                                <a href="{{ asset('storage/' . $recordPath) }}" download class="px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">Download</a>
                            </div>
                        </div>
                        @endforeach

                        <!-- Transfer Certificate -->
                        @foreach($transferCertificates as $certificatePath)
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-white rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-red-100 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Transfer Certificate</p>
                                    <p class="text-xs text-gray-500">{{ basename($certificatePath) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button onclick="openDocumentViewer('{{ asset('storage/' . $certificatePath) }}', '{{ basename($certificatePath) }}')" class="px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition-colors">View</button>
                                <a href="{{ asset('storage/' . $certificatePath) }}" download class="px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">Download</a>
                            </div>
                        </div>
                        @endforeach

                        <!-- Birth Certificate -->
                        @if($birthCertificate)
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-white rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-red-100 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Birth Certificate</p>
                                    <p class="text-xs text-gray-500">{{ basename($birthCertificate) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button onclick="openDocumentViewer('{{ asset('storage/' . $birthCertificate) }}', '{{ basename($birthCertificate) }}')" class="px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition-colors">View</button>
                                <a href="{{ asset('storage/' . $birthCertificate) }}" download class="px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">Download</a>
                            </div>
                        </div>
                        @endif

                        <!-- Report Cards -->
                        @foreach($reportCards as $reportPath)
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-white rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-red-100 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Report Cards</p>
                                    <p class="text-xs text-gray-500">{{ basename($reportPath) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button onclick="openDocumentViewer('{{ asset('storage/' . $reportPath) }}', '{{ basename($reportPath) }}')" class="px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition-colors">View</button>
                                <a href="{{ asset('storage/' . $reportPath) }}" download class="px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">Download</a>
                            </div>
                        </div>
                        @endforeach

                        <!-- No Documents Message -->
                        @if(empty($academicRecords) && empty($transferCertificates) && !$birthCertificate && empty($reportCards))

                        <div class="p-6 text-center text-gray-500 bg-gray-50 rounded-lg">
                            <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p>No documents uploaded yet</p>
                        </div>

                        @endif
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-6 border-t border-gray-200 flex items-center justify-between bg-gray-50">
                <button onclick="closeModal()" class="inline-flex items-center gap-2 px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md font-medium transition-colors">
                    Close
                </button>
                <div class="flex gap-3">
                    <button class="inline-flex items-center gap-2 px-4 py-2 bg-red-100 text-red-700 hover:bg-red-200 rounded-md font-semibold transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Reject
                    </button>
                    <button class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white hover:bg-green-700 rounded-md font-semibold shadow-md transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Approve
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Viewer Modal with iframe -->
    <div id="documentViewerModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-6xl w-full max-h-[90vh] overflow-hidden m-4">
            <!-- Modal Header -->
            <div class="p-4 border-b-2 border-university-burgundy flex items-center justify-between bg-gradient-to-r from-university-burgundy/5 to-transparent">
                <div>
                    <h2 class="text-xl font-bold text-university-burgundy">Document Viewer</h2>
                    <p id="documentName" class="text-sm text-gray-500 mt-1"></p>
                </div>
                <button onclick="closeDocumentViewer()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body with document viewer -->
            <div class="p-4 overflow-hidden relative" style="height: calc(90vh - 150px);">
                <div id="loadingIndicator" class="absolute inset-0 flex items-center justify-center bg-white z-10">
                    <div class="text-center">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-university-burgundy mx-auto"></div>
                        <p class="mt-4 text-gray-600">Loading document...</p>
                    </div>
                </div>
                <div id="documentContainer" class="w-full h-full overflow-auto bg-white p-2"></div>
            </div>

            <!-- Modal Footer -->
            <div class="p-4 border-t border-gray-200 flex items-center justify-between bg-gray-50">
                <button onclick="closeDocumentViewer()" class="inline-flex items-center gap-2 px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md font-medium transition-colors">
                    Close
                </button>
                <a id="downloadLink" href="" download class="inline-flex items-center gap-2 px-4 py-2 bg-university-burgundy text-white hover:bg-university-burgundy/90 rounded-md font-medium transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download
                </a>
            </div>
        </div>
    </div>

    <!-- Load the main app bundle; includes pdf-setup.js -->
    @vite('resources/js/app.js')

    <script>
        // Ensure worker-less rendering during development to avoid cross-origin worker issues.
        console.log('pdfjsLib available?', !!window.pdfjsLib);
        if (window.pdfjsLib) {
            pdfjsLib.GlobalWorkerOptions.disableWorker = true;
            console.log('PDF.js worker disabled for dev mode');
        } else {
            console.warn('PDF.js not loaded! Check if app.js is being imported correctly.');
        }

        // Render a PDF into canvases inside the container
        async function renderPdf(url, container, loadingIndicator) {
            console.log('renderPdf called with url:', url);
            console.log('pdfjsLib available in renderPdf?', !!window.pdfjsLib);
            console.log('GlobalWorkerOptions:', window.pdfjsLib?.GlobalWorkerOptions);
            
            if (!window.pdfjsLib) {
                console.error('PDF.js not loaded - falling back to browser viewer');
                showBrowserPdfViewer(url, container, loadingIndicator);
                return;
            }
            
            try {
                // Workaround: Use XMLHttpRequest instead of fetch to avoid middleware issues
                console.log('pdf.js: fetching PDF via XMLHttpRequest from', url);
                
                const xhr = new XMLHttpRequest();
                xhr.open('GET', url, true);
                xhr.responseType = 'arraybuffer';
                
                const arrayBuffer = await new Promise((resolve, reject) => {
                    xhr.onload = function() {
                        console.log('XHR Response - Status:', xhr.status, 'Type:', xhr.getResponseHeader('Content-Type'), 'Size:', xhr.response.byteLength);
                        if (xhr.status === 200) {
                            resolve(xhr.response);
                        } else {
                            reject(new Error(`XHR failed with status ${xhr.status}: ${xhr.statusText}`));
                        }
                    };
                    xhr.onerror = () => reject(new Error('XHR network error'));
                    xhr.send();
                });
                
                console.log('PDF ArrayBuffer size:', arrayBuffer.byteLength, 'bytes');
                
                if (arrayBuffer.byteLength < 1000) {
                    const text = new TextDecoder().decode(arrayBuffer);
                    console.warn('PDF file is suspiciously small. Content preview:', text.substring(0, 500));
                    if (!text.startsWith('%PDF')) {
                        throw new Error('File is not a valid PDF (size: ' + arrayBuffer.byteLength + ' bytes). Server may have returned an error: ' + text.substring(0, 200));
                    }
                }
                
                // Pass ArrayBuffer directly - this completely bypasses worker code path
                console.log('pdf.js: loading document from ArrayBuffer...');
                const loadingTask = pdfjsLib.getDocument({
                    data: arrayBuffer,
                    // These options ensure no worker is used
                    disableStream: true,
                    disableRange: true,
                    useWorker: false
                });
                
                console.log('pdf.js: awaiting document promise...');
                const pdf = await loadingTask.promise;
                console.log('pdf.js: loaded successfully, pages =', pdf.numPages);

                const containerWidth = container.clientWidth || container.getBoundingClientRect().width || 800;
                console.log('Container width:', containerWidth);
                
                for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                    const page = await pdf.getPage(pageNum);
                    const viewport = page.getViewport({ scale: 1 });
                    const scale = Math.min(1.5, containerWidth / viewport.width);
                    const scaledViewport = page.getViewport({ scale });

                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    canvas.width = Math.floor(scaledViewport.width);
                    canvas.height = Math.floor(scaledViewport.height);
                    canvas.className = 'block mx-auto mb-4';
                    container.appendChild(canvas);

                    console.log('pdf.js: rendering page', pageNum, 'size:', canvas.width, 'x', canvas.height);
                    await page.render({ canvasContext: ctx, viewport: scaledViewport }).promise;
                    console.log('pdf.js: rendered page', pageNum, 'successfully');
                    if (pageNum === 1) {
                        loadingIndicator.classList.add('hidden');
                    }
                }
                
                console.log('pdf.js: all pages rendered, total canvases:', container.querySelectorAll('canvas').length);
                if (!container.children.length) {
                    throw new Error('No pages rendered');
                }
            } catch (err) {
                console.error('PDF render error (will try browser fallback):', err);
                showBrowserPdfViewer(url, container, loadingIndicator);
            }
        }
        
        function showBrowserPdfViewer(url, container, loadingIndicator) {
            console.log('Showing browser PDF viewer for:', url);
            container.innerHTML = '';
            const obj = document.createElement('object');
            obj.type = 'application/pdf';
            obj.data = url;
            obj.className = 'w-full h-full';
            obj.style.minHeight = '600px';
            container.appendChild(obj);
            loadingIndicator.classList.add('hidden');
            console.log('Browser PDF viewer embedded');
        }

        function openDocumentViewer(documentPath, documentName) {
            console.log('Opening document:', documentPath); // Debug log
            
            // Extract file extension from ORIGINAL path before converting
            const fileExtension = documentPath.split('.').pop().split('?')[0].toLowerCase();
            console.log('File extension detected:', fileExtension);
            
            // Convert storage path to our custom serve-pdf route
            let actualPath = documentPath;
            if (documentPath.startsWith('/storage/') || documentPath.startsWith('http')) {
                // Extract the relative path after /storage/
                const match = documentPath.match(/\/storage\/(.+)$/);
                if (match) {
                    const relativePath = match[1];
                    const encoded = btoa(relativePath); // base64 encode
                    actualPath = '/serve-pdf/' + encoded;
                    console.log('Converted to serve-pdf route:', actualPath);
                }
            }
            
            const modal = document.getElementById('documentViewerModal');
            const container = document.getElementById('documentContainer');
            const nameElement = document.getElementById('documentName');
            const downloadLink = document.getElementById('downloadLink');
            const loadingIndicator = document.getElementById('loadingIndicator');
            
            // Show loading indicator and clear previous content
            loadingIndicator.classList.remove('hidden');
            container.innerHTML = '';
            
            // Set document name and download link
            nameElement.textContent = documentName;
            downloadLink.href = documentPath;
            
            if (fileExtension === 'pdf') {
                console.log('PDF file detected, pdfjsLib available?', !!window.pdfjsLib);
                if (window.pdfjsLib) {
                    console.log('Calling renderPdf...');
                    renderPdf(actualPath, container, loadingIndicator);
                    // Watchdog: if nothing rendered after 3s, use built-in browser PDF viewer
                    setTimeout(() => {
                        console.log('Watchdog check - canvases:', container.querySelectorAll('canvas').length, 'objects:', container.querySelectorAll('object').length);
                        if (!container.querySelector('canvas, object, iframe, embed')) {
                            console.warn('No content rendered after 3s, forcing browser PDF viewer');
                            showBrowserPdfViewer(actualPath, container, loadingIndicator);
                        }
                    }, 3000);
                } else {
                    console.warn('PDF.js not available, using browser PDF viewer');
                    showBrowserPdfViewer(actualPath, container, loadingIndicator);
                }

            } else if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExtension)) {
                // Use img tag for images
                const img = document.createElement('img');
                img.src = actualPath;
                img.className = 'max-w-full max-h-full object-contain mx-auto';
                img.onload = () => {
                    loadingIndicator.classList.add('hidden');
                };
                img.onerror = () => {
                    loadingIndicator.innerHTML = '<div class="text-center"><p class="text-red-600">Error loading image.</p></div>';
                };
                container.appendChild(img);
                
            } else {
                // For other file types, use iframe
                const iframe = document.createElement('iframe');
                iframe.src = actualPath;
                iframe.className = 'w-full h-full border border-gray-300 rounded-lg';
                iframe.onload = () => {
                    loadingIndicator.classList.add('hidden');
                    console.log('Document loaded successfully');
                };
                iframe.onerror = () => {
                    loadingIndicator.innerHTML = '<div class="text-center"><p class="text-red-600">Error loading document.</p></div>';
                };
                container.appendChild(iframe);
            }
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            console.log('Document viewer opened for:', fileExtension, 'file');
        }

        function closeDocumentViewer() {
            const modal = document.getElementById('documentViewerModal');
            const container = document.getElementById('documentContainer');
            
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            container.innerHTML = ''; // Clear content to stop loading
        }

        function openModal(index) {
            const modal = document.getElementById('studentModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('studentModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close modal when clicking outside
        document.getElementById('studentModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close document viewer modal when clicking outside
        document.getElementById('documentViewerModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDocumentViewer();
            }
        });

        // Simple sidebar toggle for mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                const sidebar = document.querySelector('[class*="md:ml-64"]');
                if (sidebar) {
                    sidebar.classList.toggle('ml-0');
                }
            });
        }
    </script>
</x-Teacher-sidebar>
