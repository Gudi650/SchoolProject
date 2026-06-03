<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--create a dynamic title"-->
    <title>{{ $title ?? '' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@latest/dist/lucide.min.js"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              brand: {
                50: '#eef2ff',
                100: '#e0e7ff',
                500: '#6366f1',
                600: '#4f46e5',
                700: '#4338ca'
              }
            }
          }
        }
      };
    </script>
    <style>
      @@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

      :root {
        --sidebar-expanded: 16rem;
        --sidebar-collapsed: 5rem;
      }

      body {
        font-family: 'Inter', sans-serif;
        background: #f8fafc;
        color: #0f172a;
      }

      .app-shell {
        min-height: 100vh;
      }

      .app-sidebar {
        width: var(--sidebar-expanded);
        transition: width 0.25s ease, transform 0.25s ease;
      }

      .app-main {
        margin-left: var(--sidebar-expanded);
        transition: margin-left 0.25s ease;
      }

      body.sidebar-collapsed .app-sidebar {
        width: var(--sidebar-collapsed);
      }

      body.sidebar-collapsed .app-main {
        margin-left: var(--sidebar-collapsed);
      }

      body.sidebar-collapsed .label-text {
        display: none;
      }

      body.sidebar-collapsed .sidebar-collapse-label {
        display: none;
      }

      @@media (max-width: 1023px) {
        .app-sidebar {
          transform: translateX(-100%);
          width: var(--sidebar-expanded);
        }

        body.mobile-sidebar-open .app-sidebar {
          transform: translateX(0);
        }

        .app-main {
          margin-left: 0;
        }
      }

      .page-fade {
        animation: pageFade 350ms ease-out both;
      }

      @@keyframes pageFade {
        from {
          opacity: 0;
          transform: translateY(8px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
    </style>
  </head>
  <body class="bg-slate-50 text-slate-900">
    <div class="fixed inset-0 z-40 bg-slate-900/40 hidden lg:hidden" data-sidebar-overlay></div>
    <div class="app-shell flex min-h-screen">
      <aside class="app-sidebar fixed inset-y-0 left-0 z-50 flex flex-col border-r border-slate-200 bg-white">
        
        <div class="flex h-16 items-center justify-between border-b border-slate-200 px-4">
          <div class="flex items-center gap-3 overflow-hidden">
            <div class="grid h-10 w-10 place-items-center rounded-lg bg-brand-600 text-white">L</div>
            <span class="label-text whitespace-nowrap text-xl font-bold">Scholaria</span>
          </div>
          <button class="rounded-lg p-2 text-slate-500 hover:bg-slate-100 lg:hidden" data-close-mobile>
            <i data-lucide="x" class="w-4 h-4"></i>
          </button>
        </div>

        <!--navigations-->
        <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4 text-sm">
            
          <a href="{{ route('library.dashboard') }}" @class(['flex items-center gap-3 rounded-lg px-3 py-2.5', 'bg-brand-50 font-medium text-brand-700' => Route::is('library.dashboard'), 'text-slate-600 hover:bg-slate-100' => !Route::is('library.dashboard')])>
            <i data-lucide="home" class="w-4 h-4"></i><span class="label-text">Dashboard</span>
          </a>

          <a href="{{ route('library.catalog') }}" @class(['flex items-center gap-3 rounded-lg px-3 py-2.5', 'bg-brand-50 font-medium text-brand-700' => Route::is('library.catalog'), 'text-slate-600 hover:bg-slate-100' => !Route::is('library.catalog')])>
            <i data-lucide="book-open" class="w-4 h-4"></i><span class="label-text">Catalog</span>
          </a>

          <a href="{{ route('library.inventory') }}" @class(['flex items-center gap-3 rounded-lg px-3 py-2.5', 'bg-brand-50 font-medium text-brand-700' => Route::is('library.inventory'), 'text-slate-600 hover:bg-slate-100' => !Route::is('library.inventory')])>
            <i data-lucide="package" class="w-4 h-4"></i><span class="label-text">Inventory</span>
          </a>
          
          {{-- 
          <a href="{{ route('library.me') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 hover:bg-slate-100">
            <span>◎</span><span class="label-text">Members</span>
          </a>
           --}}

          <a href="{{ route('library.loans') }}" @class(['flex items-center gap-3 rounded-lg px-3 py-2.5', 'bg-brand-50 font-medium text-brand-700' => Route::is('library.loans'), 'text-slate-600 hover:bg-slate-100' => !Route::is('library.loans')])>
            <i data-lucide="repeat" class="w-4 h-4"></i><span class="label-text">Loans</span>
          </a>

          <a href="{{ route('library.reservations') }}" @class(['flex items-center gap-3 rounded-lg px-3 py-2.5', 'bg-brand-50 font-medium text-brand-700' => Route::is('library.reservations'), 'text-slate-600 hover:bg-slate-100' => !Route::is('library.reservations')])>
            <i data-lucide="calendar" class="w-4 h-4"></i><span class="label-text">Reservations</span>
          </a>

          <a href="{{ route('library.reports') }}" @class(['flex items-center gap-3 rounded-lg px-3 py-2.5', 'bg-brand-50 font-medium text-brand-700' => Route::is('library.reports'), 'text-slate-600 hover:bg-slate-100' => !Route::is('library.reports')])>
            <i data-lucide="bar-chart-2" class="w-4 h-4"></i><span class="label-text">Reports</span>
          </a>

          <a href="{{ route('library.settings') }}" @class(['flex items-center gap-3 rounded-lg px-3 py-2.5', 'bg-brand-50 font-medium text-brand-700' => Route::is('library.settings'), 'text-slate-600 hover:bg-slate-100' => !Route::is('library.settings')])>
            <i data-lucide="settings" class="w-4 h-4"></i><span class="label-text">Settings</span>
          </a>

        </nav>

        <div class="border-t border-slate-200 p-4">
          <div class="flex items-center gap-3">
            <img src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="Profile" class="h-10 w-10 rounded-full border border-slate-200" />
            <div class="label-text">
              <p class="text-sm font-semibold">Ms. Carter</p>
              <p class="text-xs text-slate-500">Head Librarian</p>
            </div>
          </div>
        </div>
        <button class="absolute -right-3 top-20 hidden h-6 w-6 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-400 shadow-sm hover:bg-slate-50 lg:flex" data-toggle-collapse>
          <i data-lucide="chevrons-left" class="w-3 h-3"></i>
        </button>
      </aside>

      <div class="app-main flex min-h-screen flex-1 flex-col">
        
        <!--include the header component here-->
        <x-Library-header />

        <main class="w-full max-w-7xl mx-auto p-4 lg:p-8">
          
            <!--the main content goes here, this is just a placeholder-->
            {{ $slot }}

        </main>
      </div>
    </div>
    <script>
      (function () {
        var body = document.body;
        var mobileOpenButtons = document.querySelectorAll('[data-open-mobile]');
        var mobileCloseButtons = document.querySelectorAll('[data-close-mobile]');
        var sidebarOverlay = document.querySelector('[data-sidebar-overlay]');
        var collapseButton = document.querySelector('[data-toggle-collapse]');

        function closeMobileSidebar() {
          body.classList.remove('mobile-sidebar-open');
          if (sidebarOverlay) {
            sidebarOverlay.classList.add('hidden');
          }
        }

        mobileOpenButtons.forEach(function (btn) {
          btn.addEventListener('click', function () {
            body.classList.add('mobile-sidebar-open');
            if (sidebarOverlay) {
              sidebarOverlay.classList.remove('hidden');
            }
          });
        });

        mobileCloseButtons.forEach(function (btn) {
          btn.addEventListener('click', closeMobileSidebar);
        });

        if (sidebarOverlay) {
          sidebarOverlay.addEventListener('click', closeMobileSidebar);
        }

        if (collapseButton) {
          collapseButton.addEventListener('click', function () {
            body.classList.toggle('sidebar-collapsed');
          });
        }

        var menuButtons = document.querySelectorAll('[data-menu-button]');
        menuButtons.forEach(function (btn) {
          btn.addEventListener('click', function () {
            var panelId = btn.getAttribute('data-menu-button');
            var panel = document.querySelector('[data-menu-panel="' + panelId + '"]');
            if (!panel) return;
            var isHidden = panel.classList.contains('hidden');

            document.querySelectorAll('[data-menu-panel]').forEach(function (p) {
              p.classList.add('hidden');
            });

            if (isHidden) {
              panel.classList.remove('hidden');
            }
          });
        });

        document.addEventListener('click', function (event) {
          var target = event.target;
          if (!(target instanceof Element)) return;
          if (target.closest('[data-menu-wrap]')) return;
          document.querySelectorAll('[data-menu-panel]').forEach(function (panel) {
            panel.classList.add('hidden');
          });
        });
      })();
    </script>
    <script>
      if (window.lucide && typeof lucide.createIcons === 'function') {
        lucide.createIcons();
      }
    </script>
  </body>
</html>
