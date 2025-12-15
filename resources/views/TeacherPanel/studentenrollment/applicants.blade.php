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
                                    <p class="text-sm font-medium text-gray-600">Dec 15, 2025</p>
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
                            <span id="pending-count" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">0</span>
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
                                <tbody id="pending-tbody" class="divide-y divide-gray-200">
                                    <!-- Pending applications will be inserted here -->
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
                            <span id="approved-count" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">0</span>
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
                                <tbody id="approved-tbody" class="divide-y divide-gray-200">
                                    <!-- Approved applications will be inserted here -->
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
                            <span id="rejected-count" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">0</span>
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
                                <tbody id="rejected-tbody" class="divide-y divide-gray-200">
                                    <!-- Rejected applications will be inserted here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Application View Modal -->
    <div id="application-modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Full Name</label>
                            <p class="modal-student-name text-gray-900 font-semibold text-lg">Sarah Connor</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Email Address</label>
                            <p class="modal-student-email text-gray-900">sarah.connor@example.com</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Phone Number</label>
                            <p class="modal-student-phone text-gray-900">+1 (555) 123-4567</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Program Applied</label>
                            <p class="modal-student-program text-gray-900 font-semibold">Computer Science</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Application Date</label>
                            <p class="modal-student-date text-gray-900">October 24, 2023</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Enrollment Status</label>
                            <span class="modal-student-status inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">Pending</span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">GPA</label>
                            <p class="modal-student-gpa text-gray-900 font-semibold text-lg">3.85</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Test Score</label>
                            <p class="modal-student-test text-gray-900 font-semibold text-lg">1520 (SAT)</p>
                        </div>
                    </div>
                </div>

                <!-- Previous School Information -->
                <div class="mb-8 pb-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-university-burgundy mb-4">Previous School</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">School Name</label>
                        <p class="modal-student-school text-gray-900 font-semibold text-lg">Lincoln High School</p>
                    </div>
                </div>

                <!-- Statement of Purpose -->
                <div class="mb-8 pb-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-university-burgundy mb-3">Statement of Purpose</h3>
                    <div class="bg-university-cream rounded-lg p-6 border-l-4 border-university-burgundy">
                        <p class="modal-student-statement text-gray-700 text-sm leading-relaxed">
                            I have always been passionate about computer science and technology. Throughout my high school years, I have developed a strong foundation in programming and mathematics, which has prepared me well for university-level coursework.<br><br>
                            I am particularly interested in pursuing Computer Science at your institution because of its excellent faculty, cutting-edge curriculum, and strong industry connections. I believe that the comprehensive program will equip me with the knowledge and skills necessary to excel in this rapidly evolving field.<br><br>
                            My goal is to become a software engineer and contribute to innovative projects that solve real-world problems. I am committed to academic excellence and look forward to engaging with the vibrant community at your university.<br><br>
                            Sincerely,<br>
                            Sarah Connor
                        </p>
                    </div>
                </div>

                <!-- Attached Documents -->
                <div class="mb-8 pb-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-university-burgundy mb-4">Attached Documents</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-white rounded-lg border border-gray-200 hover:border-university-burgundy hover:shadow-md transition-all cursor-pointer" onclick="viewDocument('resume')">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-red-100 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Resume.pdf</p>
                                    <p class="text-xs text-gray-500">245 KB • Click to preview</p>
                                </div>
                            </div>
                            <button class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition-colors">
                                Download
                            </button>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-white rounded-lg border border-gray-200 hover:border-university-burgundy hover:shadow-md transition-all cursor-pointer" onclick="viewDocument('portfolio')">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-red-100 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Portfolio.pdf</p>
                                    <p class="text-xs text-gray-500">1.2 MB • Click to preview</p>
                                </div>
                            </div>
                            <button class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition-colors">
                                Download
                            </button>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-white rounded-lg border border-gray-200 hover:border-university-burgundy hover:shadow-md transition-all cursor-pointer" onclick="viewDocument('references')">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-red-100 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">References.pdf</p>
                                    <p class="text-xs text-gray-500">156 KB • Click to preview</p>
                                </div>
                            </div>
                            <button class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition-colors">
                                Download
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-6 border-t border-gray-200 flex items-center justify-between bg-gray-50">
                <button onclick="closeModal()" class="inline-flex items-center gap-2 px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-md font-medium transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Close
                </button>
                <div class="flex gap-3">
                    <button onclick="handleStatusChange(document.getElementById('application-modal').dataset.currentStudentId, 'rejected'); closeModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-red-100 text-red-700 hover:bg-red-200 rounded-md font-semibold transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Reject Enrollment
                    </button>
                    <button onclick="handleStatusChange(document.getElementById('application-modal').dataset.currentStudentId, 'approved'); closeModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white hover:bg-green-700 rounded-md font-semibold shadow-md transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Approve Enrollment
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Preview Modal -->
    <div id="document-modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-5xl w-full max-h-[90vh] overflow-hidden">
            <!-- Modal Header -->
            <div class="p-6 border-b-2 border-university-burgundy bg-gradient-to-r from-university-burgundy/5 to-transparent flex items-center justify-between">
                <h2 class="text-2xl font-bold text-university-burgundy" id="doc-title">Document Preview</h2>
                <button onclick="closeDocumentModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)] bg-white">
                <div id="document-preview" class="bg-white rounded-lg p-8">
                    <!-- Document content will be displayed here -->
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-6 border-t border-gray-200 flex items-center justify-end bg-gray-50">
                <button onclick="closeDocumentModal()" class="inline-flex items-center gap-2 px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-md font-medium transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        function toggleSidebar() {
            if (!sidebar || !sidebarOverlay || !menuIcon || !closeIcon) return;
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }



        // Student enrollments data
        const applications = [
            { id: '1', name: 'Sarah Connor', email: 'sarah@example.com', date: '2023-10-24', status: 'pending', role: 'Computer Science' },
            { id: '2', name: 'John Smith', email: 'john@example.com', date: '2023-10-23', status: 'approved', role: 'Business Administration' },
            { id: '3', name: 'Michael Chen', email: 'michael@example.com', date: '2023-10-23', status: 'rejected', role: 'Engineering' },
            { id: '4', name: 'Emily Davis', email: 'emily@example.com', date: '2023-10-22', status: 'pending', role: 'Liberal Arts' },
            { id: '5', name: 'David Wilson', email: 'david@example.com', date: '2023-10-21', status: 'approved', role: 'Pre-Med' },
            { id: '6', name: 'Lisa Anderson', email: 'lisa@example.com', date: '2023-10-20', status: 'pending', role: 'Communications' }
        ];

        // Render applications tables
        function renderApplications() {
            const pendingTbody = document.getElementById('pending-tbody');
            const approvedTbody = document.getElementById('approved-tbody');
            const rejectedTbody = document.getElementById('rejected-tbody');
            const pendingCount = document.getElementById('pending-count');
            const approvedCount = document.getElementById('approved-count');
            const rejectedCount = document.getElementById('rejected-count');

            if (!pendingTbody || !approvedTbody || !rejectedTbody) return;

            const pendingApps = applications.filter(app => app.status === 'pending');
            const approvedApps = applications.filter(app => app.status === 'approved');
            const rejectedApps = applications.filter(app => app.status === 'rejected');

            // Update counts
            if (pendingCount) pendingCount.textContent = pendingApps.length;
            if (approvedCount) approvedCount.textContent = approvedApps.length;
            if (rejectedCount) rejectedCount.textContent = rejectedApps.length;

            // Render pending enrollments
            pendingTbody.innerHTML = pendingApps.length > 0 ? pendingApps.map(app => {
                const statusColors = {
                    approved: 'bg-green-100 text-green-800',
                    rejected: 'bg-red-100 text-red-800',
                    pending: 'bg-yellow-100 text-yellow-800'
                };

                const actions = `
                    <button onclick="viewApplication('${app.id}')"  
                            class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" 
                            title="View Details">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    <button onclick="handleStatusChange('${app.id}', 'approved')" 
                            class="p-1.5 text-green-600 hover:bg-green-50 rounded-md transition-colors" 
                            title="Approve Enrollment">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </button>
                    <button onclick="handleStatusChange('${app.id}', 'rejected')" 
                            class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" 
                            title="Reject Enrollment">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <button class="p-1.5 text-gray-400 hover:text-gray-600 rounded-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                `;

                return `
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div>
                                <div class="font-medium text-gray-900">${app.name}</div>
                                <div class="text-gray-500 text-xs">${app.email}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">${app.role}</td>
                        <td class="px-6 py-4 text-gray-600">${app.date}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize ${statusColors[app.status]}">
                                ${app.status}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                ${actions}
                            </div>
                        </td>
                    </tr>
                `;
            }).join('') : '<tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">No pending enrollments</td></tr>';

            // Render approved enrollments
            approvedTbody.innerHTML = approvedApps.length > 0 ? approvedApps.map(app => {
                return `
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div>
                                <div class="font-medium text-gray-900">${app.name}</div>
                                <div class="text-gray-500 text-xs">${app.email}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">${app.role}</td>
                        <td class="px-6 py-4 text-gray-600">${app.date}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize">
                                ${app.status}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="viewApplication('${app.id}')" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="View Details">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <button class="p-1.5 text-gray-400 hover:text-gray-600 rounded-md">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }).join('') : '<tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">No approved enrollments</td></tr>';

            // Render rejected enrollments
            rejectedTbody.innerHTML = rejectedApps.length > 0 ? rejectedApps.map(app => {
                return `
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div>
                                <div class="font-medium text-gray-900">${app.name}</div>
                                <div class="text-gray-500 text-xs">${app.email}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">${app.role}</td>
                        <td class="px-6 py-4 text-gray-600">${app.date}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 capitalize">
                                ${app.status}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="viewApplication('${app.id}')" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="View Details">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <button class="p-1.5 text-gray-400 hover:text-gray-600 rounded-md">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }).join('') : '<tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">No rejected enrollments</td></tr>';
        }

        // Handle status change
        function handleStatusChange(id, newStatus) {
            const app = applications.find(a => a.id === id);
            if (app) {
                app.status = newStatus;
                renderApplications();
            }
        }

        // Hardcoded student data for each enrollment
        const studentDetails = {
            '1': {
                name: 'Sarah Connor',
                email: 'sarah.connor@example.com',
                phone: '+1 (555) 123-4567',
                program: 'Computer Science',
                date: 'October 24, 2023',
                status: 'Pending',
                statusClass: 'bg-yellow-100 text-yellow-800',
                gpa: '3.85',
                testScore: '1520 (SAT)',
                previousSchool: 'Lincoln High School',
                statement: 'I have always been passionate about computer science and technology. Throughout my high school years, I have developed a strong foundation in programming and mathematics, which has prepared me well for university-level coursework.<br><br>I am particularly interested in pursuing Computer Science at your institution because of its excellent faculty, cutting-edge curriculum, and strong industry connections. I believe that the comprehensive program will equip me with the knowledge and skills necessary to excel in this rapidly evolving field.<br><br>My goal is to become a software engineer and contribute to innovative projects that solve real-world problems. I am committed to academic excellence and look forward to engaging with the vibrant community at your university.<br><br>Sincerely,<br>Sarah Connor'
            },
            '2': {
                name: 'John Smith',
                email: 'john.smith@example.com',
                phone: '+1 (555) 234-5678',
                program: 'Business Administration',
                date: 'October 23, 2023',
                status: 'Approved',
                statusClass: 'bg-green-100 text-green-800',
                gpa: '3.72',
                testScore: '1480 (SAT)',
                previousSchool: 'Washington High School',
                statement: 'I am deeply passionate about business and entrepreneurship. With strong analytical skills and leadership experience, I am excited to pursue a degree in Business Administration. I believe your institution offers the perfect environment to develop my skills and make meaningful contributions.'
            },
            '3': {
                name: 'Michael Chen',
                email: 'michael.chen@example.com',
                phone: '+1 (555) 345-6789',
                program: 'Engineering',
                date: 'October 23, 2023',
                status: 'Rejected',
                statusClass: 'bg-red-100 text-red-800',
                gpa: '2.95',
                testScore: '1250 (SAT)',
                previousSchool: 'Central High School',
                statement: 'I have always been interested in engineering and problem-solving. I hope to contribute to innovative solutions and work on meaningful projects during my university years.'
            },
            '4': {
                name: 'Emily Davis',
                email: 'emily.davis@example.com',
                phone: '+1 (555) 456-7890',
                program: 'Liberal Arts',
                date: 'October 22, 2023',
                status: 'Pending',
                statusClass: 'bg-yellow-100 text-yellow-800',
                gpa: '3.91',
                testScore: '1510 (SAT)',
                previousSchool: 'Jefferson High School',
                statement: 'I am committed to pursuing a well-rounded education in the Liberal Arts. With diverse interests spanning humanities, sciences, and social studies, I am excited to explore interdisciplinary learning opportunities and develop critical thinking skills.'
            },
            '5': {
                name: 'David Wilson',
                email: 'david.wilson@example.com',
                phone: '+1 (555) 567-8901',
                program: 'Pre-Med',
                date: 'October 21, 2023',
                status: 'Approved',
                statusClass: 'bg-green-100 text-green-800',
                gpa: '3.98',
                testScore: '1540 (SAT)',
                previousSchool: 'Madison High School',
                statement: 'My passion for medicine and helping others has guided my academic journey. I am dedicated to pursuing a Pre-Med track to prepare for medical school and ultimately become a physician who makes a positive impact on healthcare.'
            },
            '6': {
                name: 'Lisa Anderson',
                email: 'lisa.anderson@example.com',
                phone: '+1 (555) 678-9012',
                program: 'Communications',
                date: 'October 20, 2023',
                status: 'Pending',
                statusClass: 'bg-yellow-100 text-yellow-800',
                gpa: '3.67',
                testScore: '1420 (SAT)',
                previousSchool: 'Monroe High School',
                statement: 'I am passionate about communication, media, and storytelling. I believe that effective communication is essential in today\'s world, and I am excited to develop my skills in journalism, media production, and digital communication through your comprehensive Communications program.'
            }
        };

        // View application details
        function viewApplication(id) {
            const modal = document.getElementById('application-modal');
            const student = studentDetails[id];
            
            if (student) {
                // Store the current student ID for use in approve/reject buttons
                modal.dataset.currentStudentId = id;
                
                // Update modal content with hardcoded student data
                document.querySelector('.modal-student-name').textContent = student.name;
                document.querySelector('.modal-student-email').textContent = student.email;
                document.querySelector('.modal-student-phone').textContent = student.phone;
                document.querySelector('.modal-student-program').textContent = student.program;
                document.querySelector('.modal-student-date').textContent = student.date;
                document.querySelector('.modal-student-status').textContent = student.status;
                document.querySelector('.modal-student-status').className = 'modal-student-status inline-flex items-center px-3 py-1 rounded-full text-xs font-bold ' + student.statusClass;
                document.querySelector('.modal-student-gpa').textContent = student.gpa;
                document.querySelector('.modal-student-test').textContent = student.testScore;
                document.querySelector('.modal-student-school').textContent = student.previousSchool;
                document.querySelector('.modal-student-statement').innerHTML = student.statement;
                
                modal.classList.remove('hidden');
            }
        }

        // Close modal
        function closeModal() {
            const modal = document.getElementById('application-modal');
            modal.classList.add('hidden');
        }

        // View document preview (static message)
        function viewDocument(docType) {
            const docModal = document.getElementById('document-modal');
            const docTitle = document.getElementById('doc-title');
            const docPreview = document.getElementById('document-preview');

            docTitle.textContent = 'Document Preview';
            docPreview.innerHTML = '<p>Document Preview thats it </p>';
            docModal.classList.remove('hidden');
        }

        // Close document modal
        function closeDocumentModal() {
            const docModal = document.getElementById('document-modal');
            docModal.classList.add('hidden');
        }

        // Initialize
        renderApplications();
    </script>

</x-Teacher-sidebar>