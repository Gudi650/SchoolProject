<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? '' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    
  </head>
  <body class="antialiased bg-slate-50 text-slate-900">

    <button id="mobile-menu-button" aria-expanded="false" class="md:hidden fixed top-3 left-4 z-50 w-9 h-9 bg-gradient-to-br from-indigo-600 to-purple-600 text-white rounded-lg shadow-xl flex items-center justify-center ring-1 ring-white/30 backdrop-blur-sm transform transition-all duration-300 hover:scale-105 focus:outline-none">
      <span class="sr-only">Toggle navigation</span>
      <i data-lucide="menu" class="menu-icon w-4 h-4"></i>
      <i data-lucide="x" class="close-icon w-4 h-4 hidden"></i>
    </button>
    
    <div id="mobile-overlay" class="md:hidden fixed inset-0 bg-black/50 z-30 hidden"></div>

    <aside id="sidebar" class="fixed top-0 left-0 h-screen bg-white border-r border-slate-200 z-40 w-72 -translate-x-full md:translate-x-0 transition-all duration-300 ease-in-out flex flex-col shadow-sm">
      <div class="h-16 flex items-center justify-between px-4 border-b border-slate-200">
          <div class="flex items-center gap-3">
          <div class="brand-icon w-9 h-9 bg-indigo-600 rounded-lg flex items-center justify-center shadow-sm">
            <i data-lucide="building-2" class="w-5 h-5 text-white"></i>
          </div>
          <div class="brand-text">
            <h1 class="font-semibold text-sm text-indigo-700">Accountant Portal</h1>
            <p class="text-xs text-slate-500">Admin</p>
          </div>
        </div>
        <button id="collapse-btn" aria-label="Collapse sidebar" class="hidden md:flex items-center justify-center w-8 h-8 rounded-full bg-white border-2 border-slate-200 text-slate-600 hover:border-indigo-400 hover:bg-indigo-50 hover:text-indigo-600 shadow-sm hover:shadow-md transition-all duration-200 group">
          <i data-lucide="chevron-left" class="w-4 h-4"></i>
        </button>
      </div>

      <nav class="flex-1 overflow-y-auto pt-2 px-3 min-h-0">
          <ul class="space-y-1">
          <li>
            <a href="{{ route('accounting.dashboard') }}" 
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('accounting.dashboard') ? 'text-indigo-700 bg-indigo-100/50' : 'text-slate-700 hover:bg-indigo-100/50 hover:text-indigo-700' }}">
              <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
              <span class="flex-1 text-left text-sm font-medium nav-label">
                Dashboard
              </span>
            </a>
          </li>
          
          <li>
            <a href="{{ route('accounting.feeManagement') }}" 
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('accounting.feeManagement') ? 'text-indigo-700 bg-indigo-100/50' : 'text-slate-700 hover:bg-indigo-100/50 hover:text-indigo-700' }}">
              <i data-lucide="dollar-sign" class="w-5 h-5"></i>
              <span class="flex-1 text-left text-sm font-medium nav-label">Fee Management</span>
              <span class="item-badge px-2 py-0.5 text-xs font-semibold bg-red-500 text-white rounded-full">12</span>
            </a>
          </li>

          <li>
            <a href="{{ route('accounting.incomeManagement') }}" 
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('accounting.incomeManagement') ? 'text-indigo-700 bg-indigo-100/50' : 'text-slate-700 hover:bg-indigo-100/50 hover:text-indigo-700' }}">
              <i data-lucide="trending-up" class="w-5 h-5"></i>
              <span class="flex-1 text-left text-sm font-medium nav-label">Income</span>
            </a>
          </li>

          <li>
            <a href="{{ route('accounting.expensesManagement') }}" 
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('accounting.expensesManagement') ? 'text-indigo-700 bg-indigo-100/50' : 'text-slate-700 hover:bg-indigo-100/50 hover:text-indigo-700' }}">
              <i data-lucide="trending-down" class="w-5 h-5"></i>
              <span class="flex-1 text-left text-sm font-medium nav-label">Expenses</span>
            </a>
          </li>

          <li>
            <a href="{{ route('accounting.payrollManagement') }}" 
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('accounting.payrollManagement') ? 'text-indigo-700 bg-indigo-100/50' : 'text-slate-700 hover:bg-indigo-100/50 hover:text-indigo-700' }}">
              <i data-lucide="users" class="w-5 h-5"></i>
              <span class="flex-1 text-left text-sm font-medium nav-label">Payroll</span>
            </a>
          </li>

          <li>
            <a href="{{ route('accounting.bankingCashManagement') }}" 
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('accounting.bankingCashManagement') ? 'text-indigo-700 bg-indigo-100/50' : 'text-slate-700 hover:bg-indigo-100/50 hover:text-indigo-700' }}">
              <i data-lucide="building-2" class="w-5 h-5"></i>
              <span class="flex-1 text-left text-sm font-medium nav-label">Banking & Cash</span>
            </a>
          </li>

          <li>
            <a href="{{ route('accounting.vendorsManagement') }}" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('accounting.vendorsManagement') ? 'text-indigo-700 bg-indigo-100/50' : 'text-slate-700 hover:bg-indigo-100/50 hover:text-indigo-700' }}">
              <i data-lucide="receipt" class="w-5 h-5"></i>
              <span class="flex-1 text-left text-sm font-medium nav-label">Vendors</span>
            </a>
          </li>

          <li>
            <a href="{{ route('accounting.budgetingManagement') }}" 
              class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('accounting.budgetingManagement') ? 'text-indigo-700 bg-indigo-100/50' : 'text-slate-700 hover:bg-indigo-100/50 hover:text-indigo-700' }}">
              <i data-lucide="pie-chart" class="w-5 h-5"></i>
              <span class="flex-1 text-left text-sm font-medium nav-label">Budget</span>
            </a>
          </li>

          <li>
            <a href="{{ route('accounting.reportsManagement') }}" 
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('accounting.reportsManagement') ? 'text-indigo-700 bg-indigo-100/50' : 'text-slate-700 hover:bg-indigo-100/50 hover:text-indigo-700' }}">
            <i data-lucide="file-text" class="w-5 h-5"></i><span class="flex-1 text-left text-sm font-medium nav-label">Reports</span>
            </a>
          </li>

          <li>
            <a href="{{ route('accounting.invoiceManagement') }}"
             class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('accounting.invoiceManagement') ? 'text-indigo-700 bg-indigo-100/50' : 'text-slate-700 hover:bg-indigo-100/50 hover:text-indigo-700' }}">
             <i data-lucide="credit-card" class="w-5 h-5"></i>
             <span class="flex-1 text-left text-sm font-medium nav-label">Invoicing</span>
            </a>
          </li>

          <li>
            <a href="{{ route('accounting.settings') }}" 
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('accounting.settings') ? 'text-indigo-700 bg-indigo-100/50' : 'text-slate-700 hover:bg-indigo-100/50 hover:text-indigo-700' }}"><i data-lucide="settings" class="w-5 h-5"></i><span class="flex-1 text-left text-sm font-medium nav-label">Settings</span>
            </a>
          </li>
        </ul>
      </nav>

      <div class="px-3 py-4 border-t border-slate-200 bg-white">
          <button id="logout-btn" class="w-full relative pl-10 pr-3 py-2.5 rounded-lg text-sm font-medium text-red-700 border border-red-100 hover:bg-red-100 hover:text-red-800 transition-colors">
            <span class="logout-icon absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-red-600">
              <i data-lucide="log-out" class="w-5 h-5"></i>
            </span>
            <span class="logout-label block w-full text-center">Logout</span>
        </button>
      </div>
    
    </aside>

    <div id="main-wrapper" class="md:pl-72 relative z-0 transition-all duration-300 ease-in-out">
      <header class="h-16 sticky top-0 z-30 bg-white border-b border-slate-200 pl-16 pr-6 md:pl-6 flex items-center justify-between">
        <div class="flex-1 max-w-xl">
          <div class="relative">
            <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
            <input type="text" placeholder="Search transactions, students, invoices..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
          </div>
        </div>

        <div class="flex items-center gap-4">
          <div class="hidden md:block text-sm text-slate-600">
            <span class="font-medium">Today:</span>
            <span id="date-text"></span>
          </div>

          <button class="relative p-2 hover:bg-slate-100 rounded-lg transition-colors">
            <i data-lucide="bell" class="w-5 h-5 text-slate-600"></i>
            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
          </button>

          <button class="flex items-center gap-3 pl-3 pr-2 py-1.5 hover:bg-slate-100 rounded-lg transition-colors">
            <div class="text-right hidden sm:block">
              <p class="text-sm font-medium text-slate-900">Sarah Johnson</p>
              <p class="text-xs text-slate-500">Chief Accountant</p>
            </div>
            <div class="w-9 h-9 bg-blue-500 rounded-full flex items-center justify-center">
              <i data-lucide="user" class="w-5 h-5 text-white"></i>
            </div>
            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
          </button>
        </div>
      </header>

      <main class="p-6 bg-white">

        <!--main content-->
        {{ $slot }}

      </main>
    </div>


</body>

<script>
 //initialize lucide icons
 lucide.createIcons();

    // Minimal, compact page JS
    document.addEventListener('DOMContentLoaded', function(){
        if (window.lucide && typeof window.lucide.replace === 'function') try{ window.lucide.replace(); }catch(e){}

        const sidebar = document.getElementById('sidebar');
        const mobileBtn = document.getElementById('mobile-menu-button');
        const overlay = document.getElementById('mobile-overlay');
        const collapseBtn = document.getElementById('collapse-btn');
        const mainWrapper = document.getElementById('main-wrapper');

        // mobile toggle
        if (mobileBtn && overlay && sidebar){
          mobileBtn.addEventListener('click', ()=>{ overlay.classList.toggle('hidden'); sidebar.classList.toggle('-translate-x-full'); mobileBtn.querySelector('.menu-icon')?.classList.toggle('hidden'); mobileBtn.querySelector('.close-icon')?.classList.toggle('hidden'); });
          overlay.addEventListener('click', ()=>{ overlay.classList.add('hidden'); sidebar.classList.add('-translate-x-full'); mobileBtn.querySelector('.menu-icon')?.classList.remove('hidden'); mobileBtn.querySelector('.close-icon')?.classList.add('hidden'); });
        }

        // collapse/expand sidebar
        if (collapseBtn && sidebar){
          collapseBtn.addEventListener('click', ()=>{
            const isExpanded = sidebar.classList.contains('w-72');
            sidebar.classList.toggle('w-72', !isExpanded); sidebar.classList.toggle('w-20', isExpanded);
            if (mainWrapper) { mainWrapper.classList.toggle('md:pl-72', !isExpanded); mainWrapper.classList.toggle('md:pl-20', isExpanded); }
            sidebar.querySelectorAll('nav a').forEach(a=>{ a.classList.toggle('justify-center', isExpanded); a.querySelector('.nav-label')?.classList.toggle('hidden', isExpanded); a.querySelector('.item-badge')?.classList.toggle('hidden', isExpanded); });
            sidebar.querySelector('.brand-text')?.classList.toggle('hidden', isExpanded); sidebar.querySelector('.brand-icon')?.classList.toggle('hidden', isExpanded);
            collapseBtn.querySelector('i')?.classList.toggle('rotate-180', isExpanded);

            // logout compact toggle (simple class toggles)
            const logoutBtn = document.getElementById('logout-btn');
            const label = logoutBtn?.querySelector('.logout-label');
            const iconWrap = logoutBtn?.querySelector('.logout-icon');
            if (logoutBtn){
              if (isExpanded){
                // switch to compact
                logoutBtn.classList.add('inline-flex','items-center','justify-center','w-10','h-10','mx-auto','my-2');
                if (iconWrap) { iconWrap.classList.remove('absolute','left-3','top-1/2','-translate-y-1/2'); iconWrap.classList.add('flex','items-center','justify-center'); }
                if (label) label.classList.add('hidden');
              } else {
                // restore
                logoutBtn.classList.remove('inline-flex','items-center','justify-center','w-10','h-10','mx-auto','my-2');
                if (iconWrap) { iconWrap.classList.remove('flex','items-center','justify-center'); iconWrap.classList.add('absolute','left-3','top-1/2','-translate-y-1/2'); }
                if (label) label.classList.remove('hidden');
              }
            }
          });
        }

        // date and logout
        const dateEl = document.getElementById('date-text'); if (dateEl) dateEl.textContent = new Date().toLocaleDateString('en-US', { weekday:'short', year:'numeric', month:'short', day:'numeric' });
        
        const logoutBtn = document.getElementById('logout-btn'); if (logoutBtn) logoutBtn.addEventListener('click', e=>{ e.preventDefault(); if (confirm('Log out?')) location.href='index.html'; });
    });

</script>
</html>