<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Homepage — Frontend (Tailwind)</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="flex">
  <aside id="sidebar" class="hidden md:block fixed left-0 top-0 h-screen w-64 bg-white border-r border-gray-200 p-4">
      <h1 class="text-indigo-600 text-xl font-semibold mb-2">Student Portal</h1>
      <div class="w-full border-b border-gray-200 mb-4"></div>
      <nav class="space-y-2">

        <a id="active" href="{{ route('student.homepage') }}" class="flex items-center gap-3 p-2 rounded-md bg-indigo-50 text-indigo-600">
            <i class="bi bi-person"></i> Profile
        </a>

        <a href="{{ route('student.exams') }}" class="flex items-center gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
            <i class="bi bi-mortarboard"></i> Exam Results
        </a>

        <a href="{{ route('student.timetable') }}" class="flex items-center gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
            <i class="bi bi-calendar3"></i> Timetable
        </a>

        <a href="{{ route('student.library') }}" class="flex items-center gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
            <i class="bi bi-book"></i> Library
        </a>

        <a href="student/health.html" class="flex items-center gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
            <i class="bi bi-heart-pulse"></i> Health Status
        </a>

        <a href="{{ route('student.feespayment') }}" class="flex items-center gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
            <i class="bi bi-cash-coin"></i> Fees Payment
        </a>

        <!-- Attendance dropdown -->
        <div class="relative">
          <button id="attendanceToggle" aria-expanded="false" class="w-full flex items-center justify-between gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
            <span class="flex items-center gap-3"><i class="bi bi-calendar-check"></i> Attendance</span>
            <i class="bi bi-chevron-down text-sm transition-transform duration-200"></i>
          </button>

          <!-- inline submenu: appears like other sidebar links but indented -->
          <ul id="attendanceMenu" class="hidden mt-1 space-y-1">
      <li>
        <a href="{{ route('student.attendance.checkin') }}" class="group flex items-center gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 pl-10">
          <i class="bi bi-person-check text-lg text-gray-600 group-hover:text-indigo-600 transition-colors duration-150"></i>
          <span>Check In</span>
        </a>
      </li>
      <li>
        <a href="{{ route('student.attendance.report') }}" class="group flex items-center gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 pl-10">

          <i class="bi bi-file-earmark-text text-lg text-gray-600 group-hover:text-indigo-600 transition-colors duration-150"></i>

          <span>Report</span>
        </a>
      </li>
          </ul>
        </div>
        <a href="{{ route('student.announcements') }}" class="flex items-center gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
          <i class="bi bi-bell"></i> Announcement
        </a>
        
        <a href="{{ route('student.assignments') }}" class="flex items-center gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
          <i class="bi bi-journal-check"></i> Assignments
        </a>
      </nav>
      <div class="absolute bottom-4 left-4 right-4">
        <form action="{{ route('logout') }}" method="POST">

          @csrf

          <button class="w-full text-red-500 flex items-center justify-center gap-2 p-2 rounded-md border border-gray-100 hover:bg-red-50 hover:text-red-700 transition-colors duration-150"><i class="bi bi-box-arrow-right"></i> Log Out</button>

        </form>

      </div>
    </aside>

   <!-- Main content area -->

    {{ $slot }}

  </div>
</div>

  <!-- Overlay for mobile sidebar -->
  <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-30"></div>

  <script>
    // Mobile-friendly sidebar + attendance submenu (robust)
    document.addEventListener('DOMContentLoaded', function() {
      const sidebar = document.getElementById('sidebar');
      const sidebarToggle = document.getElementById('sidebarToggle');
      const sidebarOverlay = document.getElementById('sidebarOverlay');
      const mainElement = document.querySelector('main');

      // Require sidebar and overlay; sidebarToggle may be optional per-page
      if (!sidebar || !sidebarOverlay) return;

      function openSidebar(){
        sidebar.classList.remove('hidden');
        sidebarOverlay.classList.remove('hidden');
        if(mainElement) mainElement.classList.add('pointer-events-none');
      }
      function closeSidebar(){
        sidebar.classList.add('hidden');
        sidebarOverlay.classList.add('hidden');
        if(mainElement) mainElement.classList.remove('pointer-events-none');
      }

      if(sidebarToggle){
        sidebarToggle.addEventListener('click', function(e){
          e.preventDefault();
          e.stopPropagation();
          if(sidebar.classList.contains('hidden')) openSidebar(); else closeSidebar();
        });
      }

      if(sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);

      // Close on nav link click (mobile)
      sidebar.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function() {
          if (window.innerWidth <= 768) closeSidebar();
        });
      });

      // Attendance submenu (robust handling)
      const attendanceToggle = document.getElementById('attendanceToggle');
      const attendanceMenu = document.getElementById('attendanceMenu');
      if(attendanceToggle && attendanceMenu){
        const attendanceChevron = attendanceToggle.querySelector('.bi-chevron-down');

        attendanceToggle.addEventListener('click', function(e){
          e.preventDefault();
          e.stopPropagation(); // prevent document click from immediately closing it
          const nowOpen = attendanceMenu.classList.toggle('hidden') === false;
          attendanceToggle.setAttribute('aria-expanded', nowOpen);
          if(attendanceChevron) attendanceChevron.classList.toggle('rotate-180', nowOpen);
        });

        // Close when clicking outside (use capture to ensure reliable ordering)
        document.addEventListener('click', function(e){
          if(!attendanceToggle.contains(e.target) && !attendanceMenu.contains(e.target)){
            if(!attendanceMenu.classList.contains('hidden')){
              attendanceMenu.classList.add('hidden');
              attendanceToggle.setAttribute('aria-expanded','false');
              if(attendanceChevron) attendanceChevron.classList.remove('rotate-180');
            }
          }
        }, true);

        // mobile: close submenu when selecting an item
        attendanceMenu.querySelectorAll('a').forEach(item => {
          item.addEventListener('click', function(){
            if(window.innerWidth <= 768) closeSidebar();
            attendanceMenu.classList.add('hidden');
            attendanceToggle.setAttribute('aria-expanded','false');
            if(attendanceChevron) attendanceChevron.classList.remove('rotate-180');
          });
        });
      }

      // Keep layout consistent on resize
      window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
          sidebar.classList.remove('hidden');
          sidebarOverlay.classList.add('hidden');
          if(mainElement) mainElement.classList.remove('pointer-events-none');
        } else {
          sidebar.classList.add('hidden');
        }
      });
    });
  </script>
</body>
</html>