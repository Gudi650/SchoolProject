<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = "csrf-token" content = "{{ csrf_token() }}">
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
    
    <livewire:student-enrollment :schools="$schools"/>

    

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
            
            // Only setup if elements exist on this step
            if (!input || !listContainer) {
                return;
            }
            
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
            if (academicRecordsContainer && fileUploadHandlers.academicRecords.length > 0) {
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
            } else if (academicRecordsContainer) {
                academicRecordsContainer.innerHTML = '<span class="text-sm text-slate-400">No files uploaded</span>';
            }

            // Update Transfer Certificate
            const transferCertContainer = document.getElementById('reviewTransferCert');
            if (transferCertContainer && fileUploadHandlers.transferCert) {
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
            } else if (transferCertContainer) {
                transferCertContainer.innerHTML = '<span class="text-sm text-slate-400">No files uploaded</span>';
            }

            // Update Birth Certificate
            const birthCertContainer = document.getElementById('reviewBirthCert');
            if (birthCertContainer && fileUploadHandlers.birthCert) {
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
            } else if (birthCertContainer) {
                birthCertContainer.innerHTML = '<span class="text-sm text-slate-400">No files uploaded</span>';
            }

            // Update Report Cards (optional)
            const reportCardsSection = document.getElementById('reviewReportCardsSection');
            const reportCardsContainer = document.getElementById('reviewReportCards');
            if (reportCardsSection && reportCardsContainer && fileUploadHandlers.reportCards.length > 0) {
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
            } else if (reportCardsSection) {
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

        // Listen for Livewire updates and sync the step display
        document.addEventListener('livewire:updated', function() {
            // Get the current step from Livewire component
            const stepElement = document.querySelector('[wire\\:ignore]');
            if (stepElement) {
                const stepText = stepElement.textContent;
                const match = stepText.match(/Step:\s*(\d+)/);
                if (match) {
                    const currentStep = parseInt(match[1]);
                    goToStep(currentStep);
                }
            }
        });

        // Reinitialize file uploads on step change
        document.addEventListener('livewire:updated', function() {
            setupFileUpload('academicRecords', 'academicRecordsList', true);
            setupFileUpload('reportCards', 'reportCardsList', true);
            setupFileUpload('transferCert', 'transferCertList', false);
            setupFileUpload('birthCert', 'birthCertList', false);
        });
    </script>
</body>
</html>

