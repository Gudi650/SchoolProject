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

    


</body>
</html>

