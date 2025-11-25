<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Teacher Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">
  </head>
  <body class="bg-gray-50 text-gray-800">
    <div class="flex">
      <!-- Sidebar -->
      <aside id="sidebar" class="hidden md:block fixed left-0 top-0 h-screen w-64 bg-white border-r border-gray-200 p-4 z-40">
        <style>
          /* hide scrollbar but keep scrolling behavior */
          .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
          .no-scrollbar::-webkit-scrollbar { display: none; }
        </style>
        <div class="flex flex-col h-full">
          <div>
            <h1 class="text-indigo-600 text-xl font-semibold mb-2">
              Teacher Portal
            </h1>
            <div class="w-full border-b border-gray-200 mb-4"></div>

          </div>

          <!-- scrollable nav area -->
          <nav class="flex-1 overflow-y-auto space-y-2 pr-2 no-scrollbar">

              <a href="{{ route('teacher.dashboard') }}" class="flex items-center gap-3 p-2 rounded-md bg-indigo-50 text-indigo-600">
                <i class="bi bi-house-door-fill"></i>
                Dashboard
              </a>

              <a href="{{ route('teacher.announcements') }}" class="flex items-center gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
                <i class="bi bi-megaphone"></i>
                Announcements
              </a>

              <a href="{{ route('teacher.profile') }}" class="flex items-center gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
                <i class="bi bi-person-circle"></i>
                 Profile
              </a>

            <div class="relative">

              <button id="examsToggle" aria-expanded="false" class="w-full flex items-center justify-between gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
                <span class="flex items-center gap-3">
                  <i class="bi bi-journal-text"></i>
                   Exams
                </span>
                <i class="bi bi-chevron-down text-sm transition-transform duration-200"></i>

              </button>

              <ul id="examsMenu" class="hidden mt-1 space-y-1 pl-10">
                <li>
                  <a href="{{ route('teacher.postresults') }}" class="flex items-center gap-3 p-2 text-gray-600 hover:text-indigo-600">
                    <i class="bi bi-journal-plus text-lg"></i>
                     Post Exam Results
                  </a>
                </li>

                <li>
                  <a href="{{ route('teacher.generateresults') }}" class="flex items-center gap-3 p-2 text-gray-600 hover:text-indigo-600">
                    <i class="bi bi-calculator text-lg"></i>
                     Generate Exam Results
                    </a>
                </li>

                <li>
                  <a href="{{ route('teacher.examanalysis') }}" class="flex items-center gap-3 p-2 text-gray-600 hover:text-indigo-600">
                    <i class="bi bi-graph-up text-lg"></i>
                     Exam Results Analysis
                    </a>
                </li>

              </ul>
            </div>
          <div class="relative">

            <button id="scheduleToggle" aria-expanded="false" class="w-full flex items-center justify-between gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
              <span class="flex items-center gap-3">
                <i class="bi bi-calendar3"></i>
                 Schedule
              </span>
              <i class="bi bi-chevron-down text-sm transition-transform duration-200"></i>
            </button>

            <ul id="scheduleMenu" 
            class="hidden mt-1 space-y-1 pl-10">
        
              <li>
                <a href="{{ route('teacher.schedule') }}" 
                class="flex items-center gap-3 p-2 text-gray-600 hover:text-indigo-600">
                <i class="bi bi-calendar-week"></i>
                 View Schedule
                </a>
              </li>

              <li>
                <a href="{{ route('teacher.generatetimetable') }}" 
                class="flex items-center gap-3 p-2 text-gray-600 hover:text-indigo-600">
                  <i class="bi bi-table"></i> 
                  Generate Timetable
                </a>
              </li>

              <li>
                <a href="{{ route('teacher.generateexamtimetable') }}" 
                class="flex items-center gap-3 p-2 text-gray-600 hover:text-indigo-600">
                  <i class="bi bi-calendar-event"></i> 
                  Generate Exam Timetable
                </a>
            </li>
            </ul>

          </div>
            <a href="./online_classes.html" 
              class="flex items-center gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
              <i class="bi bi-camera-video"></i> 
              Online Classes
            </a>
            
            <!-- Attendance dropdown -->
            <div class="relative">
              
              <button id="attendanceToggle" aria-expanded="false"   class="w-full flex items-center justify-between gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
                <span class="flex items-center gap-3">
                  <i class="bi bi-calendar-check"></i> 
                  Attendance
                </span>
                <i class="bi bi-chevron-down text-sm transition-transform duration-200"></i>
              </button>

              <ul id="attendanceMenu" class="hidden mt-1 space-y-1">

                <li>
                  <a href="{{ route('teacher.registerstudentattendance.view') }}" 
                    class="group flex items-center gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 pl-10">
                      <i class="bi bi-person-plus text-lg text-gray-600 group-hover:text-indigo-600 transition-colors duration-150"></i>
                      <span>Register</span>
                  </a>
                </li>

                <li>
                  <a href="{{ route('studentattendancereport') }}" 
                    class="group flex items-center gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 pl-10">
                      <i class="bi bi-file-earmark-text text-lg text-gray-600 group-hover:text-indigo-600 transition-colors duration-150"></i>
                      <span>Records</span>
                  </a>
                </li>
              </ul>
            </div>

            <a href="./users.html" 
              class="flex items-center gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
                <i class="bi bi-people"></i> 
                Students
            </a>

            <div class="relative">
              <button id="assignToggle" aria-expanded="false"     class="w-full flex items-center justify-between gap-3 p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
                <span class="flex items-center gap-3">
                  <i class="bi bi-people-fill"></i> 
                  Assign
                </span>
                <i class="bi bi-chevron-down text-sm transition-transform duration-200"></i>
              </button>

              <ul id="assignMenu" class="hidden mt-1 space-y-1">

                <li>
                  <a href="{{ route('teacher.assignroles') }}" 
                    class="group block w-full p-2 pl-0 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
                      <span class="pl-6 flex items-center gap-3 w-full">
                        <i class="bi bi-person-badge text-lg"></i>
                        <span>Assign Roles</span>
                      </span>
                  </a>
                </li>

                <li>
                  <a href="{{ route('teacher.assignsubjects') }}" class="group block w-full p-2 pl-0 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
                    <span class="pl-6 flex items-center gap-3 w-full">
                      <i class="bi bi-journal-bookmark text-lg"></i>
                      <span>Assign Subjects</span>
                    </span>
                  </a>
                </li>

                <li>
                  <a href="{{ route('teacher.assignclasses') }}" 
                  class="group block w-full p-2 pl-0 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
                    <span class="pl-6 flex items-center gap-3 w-full">
                      <i class="bi bi-journal-bookmark text-lg"></i>
                      <span>Assign Classes</span>
                    </span>
                  </a>
                </li>

              </ul>
            </div>

            <div class="pt-4">
              <div class="w-full border-t border-gray-100 pt-3"></div>
              <div class="py-3 px-0">
                <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button class="w-full text-red-500 flex items-center justify-center gap-2 p-2 rounded-md border border-gray-100 hover:bg-red-50 hover:text-red-700 transition-colors duration-150"><i class="bi bi-box-arrow-right"></i> Log Out</button>

              </form>
              </div>
            </div>

            

          </nav>
        </div>
      </aside>

      <!-- Overlay for mobile sidebar -->
      <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-30"></div>


    <!-- Main content area -->

    {{ $slot }}

    </div>
 <script>
    // Shared JS for sidebar toggle, read-more and tag filtering
    document.addEventListener('DOMContentLoaded', function () {
      // Sidebar toggle for mobile
      const sidebar = document.getElementById('sidebar');
      const sidebarToggle = document.getElementById('sidebarToggle');
      const overlay = document.getElementById('sidebarOverlay');
      if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
          if (sidebar) sidebar.classList.toggle('hidden');
          if (overlay) overlay.classList.toggle('hidden');
        });
      }
      if (overlay) {
        overlay.addEventListener('click', function () {
          if (sidebar) sidebar.classList.add('hidden');
          overlay.classList.add('hidden');
        });
      }

    // Schedule dropdown (View Schedule, Generate Timetable, Generate Exam Timetable)
    const scheduleToggle = document.getElementById('scheduleToggle');
    const scheduleMenu = document.getElementById('scheduleMenu');
    if (scheduleToggle && scheduleMenu) {
      const scheduleChevron = scheduleToggle.querySelector('.bi-chevron-down');
      scheduleToggle.addEventListener('click', function (e) {
        e.preventDefault();
        const open = scheduleMenu.classList.toggle('hidden') === false;
        scheduleToggle.setAttribute('aria-expanded', open);
        if (scheduleChevron) scheduleChevron.classList.toggle('rotate-180', open);
      });
      // close when clicking outside, but do NOT close when clicking a submenu link (so navigation keeps it open)
      document.addEventListener('click', function (e) {
        const target = e.target;
        if (scheduleMenu.contains(target) && (target.closest && target.closest('a'))) return;
        if (!scheduleToggle.contains(target) && !scheduleMenu.contains(target)) {
          scheduleMenu.classList.add('hidden');
          scheduleToggle.setAttribute('aria-expanded', 'false');
          if (scheduleChevron) scheduleChevron.classList.remove('rotate-180');
        }
      });
    }

      // Attendance dropdown (used by student + teacher sidebars)
      const attendanceToggle = document.getElementById('attendanceToggle');
      const attendanceMenu = document.getElementById('attendanceMenu');
      if (attendanceToggle && attendanceMenu) {
        const attendanceChevron = attendanceToggle.querySelector('.bi-chevron-down');
        attendanceToggle.addEventListener('click', function (e) {
          e.preventDefault();
          const open = attendanceMenu.classList.toggle('hidden') === false;
          attendanceToggle.setAttribute('aria-expanded', open);
          if (attendanceChevron) attendanceChevron.classList.toggle('rotate-180', open);
        });
        document.addEventListener('click', function (e) {
          if (!attendanceToggle.contains(e.target) && !attendanceMenu.contains(e.target)) {
            attendanceMenu.classList.add('hidden');
            attendanceToggle.setAttribute('aria-expanded', 'false');
            if (attendanceChevron) attendanceChevron.classList.remove('rotate-180');
          }
        });
      }

      // Exams dropdown (teacher sidebar)
      const examsToggle = document.getElementById('examsToggle');
      const examsMenu = document.getElementById('examsMenu');
      if (examsToggle && examsMenu) {
        const examsChevron = examsToggle.querySelector('.bi-chevron-down');
        examsToggle.addEventListener('click', function (e) {
          e.preventDefault();
          const open = examsMenu.classList.toggle('hidden') === false;
          examsToggle.setAttribute('aria-expanded', open);
          if (examsChevron) examsChevron.classList.toggle('rotate-180', open);
        });
      }

      // Assign dropdown (Assign Roles + Assign Classes)
      const assignToggle = document.getElementById('assignToggle');
      const assignMenu = document.getElementById('assignMenu');
      if (assignToggle && assignMenu) {
        const assignChevron = assignToggle.querySelector('.bi-chevron-down');
        assignToggle.addEventListener('click', function (e) {
          e.preventDefault();
          const open = assignMenu.classList.toggle('hidden') === false;
          assignToggle.setAttribute('aria-expanded', open);
          if (assignChevron) assignChevron.classList.toggle('rotate-180', open);
        });
        // close when clicking outside, but do NOT close when clicking a submenu link (so navigation keeps it open)
        document.addEventListener('click', function (e) {
          const target = e.target;
          // if the click was on a submenu anchor inside assignMenu, allow the navigation — do not close here
          if (assignMenu.contains(target) && (target.closest && target.closest('a'))) return;
          if (!assignToggle.contains(target) && !assignMenu.contains(target)) {
            assignMenu.classList.add('hidden');
            assignToggle.setAttribute('aria-expanded', 'false');
            if (assignChevron) assignChevron.classList.remove('rotate-180');
          }
        });
      }

      // (Removed unused handlers: read-more, tag filters, search, and student form switches)
    });
    </script>
  </body>
</html>