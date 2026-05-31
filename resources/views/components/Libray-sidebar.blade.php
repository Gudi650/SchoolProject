<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--create a dynamic title"-->
    <title>{{ $title ?? '' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
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
    <link rel="stylesheet" href="./assets/styles.css" />
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
          <button class="rounded-lg p-2 text-slate-500 hover:bg-slate-100 lg:hidden" data-close-mobile>✕</button>
        </div>

        <!--navigations-->
        <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4 text-sm">
          <a href="./index.html" class="flex items-center gap-3 rounded-lg bg-brand-50 px-3 py-2.5 font-medium text-brand-700">
            <span>⌂</span><span class="label-text">Dashboard</span>
          </a>

          <a href="./catalog.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 hover:bg-slate-100">
            <span>◫</span><span class="label-text">Catalog</span>
          </a>

          <a href="./inventory.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 hover:bg-slate-100">
            <span>▦</span><span class="label-text">Inventory</span>
          </a>
          
          <a href="./members.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 hover:bg-slate-100">
            <span>◎</span><span class="label-text">Members</span>
          </a>

          <a href="./loans.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 hover:bg-slate-100">
            <span>⇄</span><span class="label-text">Loans</span>
          </a>

          <a href="./reservations.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 hover:bg-slate-100">
            <span>◷</span><span class="label-text">Reservations</span>
          </a>

          <a href="./reports.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 hover:bg-slate-100">
            <span>▤</span><span class="label-text">Reports</span>
          </a>

          <a href="./settings.html" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 hover:bg-slate-100">
            <span>⚙</span><span class="label-text">Settings</span>
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
        <button class="absolute -right-3 top-20 hidden h-6 w-6 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-400 shadow-sm hover:bg-slate-50 lg:flex" data-toggle-collapse>⇆</button>
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
    <script src="./assets/app.js"></script>
  </body>
</html>
