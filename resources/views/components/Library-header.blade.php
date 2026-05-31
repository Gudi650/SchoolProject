<header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 lg:px-8 sticky top-0 z-30">
          <div class="flex items-center gap-4 flex-1">
            <!--in smaller screens-->
            <button class="p-2 -ml-2 text-slate-500 hover:bg-slate-100 rounded-lg lg:hidden" data-open-mobile>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>

            <!-- Search Bar -->
            <div class="max-w-md w-full hidden sm:block relative" data-menu-wrap>
              <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" /></svg>
              <input type="text" placeholder="Search books, members, ISBN..." class="w-full bg-slate-50 border border-slate-200 rounded-lg pl-10 pr-12 py-2 text-sm text-slate-900 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all" />
              <div class="absolute right-3 top-1/2 -translate-y-1/2 flex items-center gap-1">
                <kbd class="hidden md:inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-medium text-slate-400 bg-white border border-slate-200 rounded shadow-sm">⌘K</kbd>
              </div>
            </div>

          </div>

          <div class="flex items-center gap-2 sm:gap-4">
            <!--onclik the notification button this appears-->
            <div class="relative" data-menu-wrap>
              <button class="p-2 -mr-1 text-slate-500 hover:bg-slate-100 rounded-lg" data-menu-button="notif">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405C18.21 14.79 18 13.91 18 13V9a6 6 0 10-12 0v4c0 .91-.21 1.79-.595 2.595L4 17h5m6 0a3 3 0 11-6 0m6 0H9"/></svg>
              </button>
              <div class="absolute right-0 mt-2 hidden w-80 bg-white border border-slate-200 rounded-xl shadow-lg overflow-hidden" data-menu-panel="notif">
                <div class="p-3 border-b border-slate-100">
                  <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Notifications</p>
                </div>
                <div class="p-2 space-y-2">
                  <div class="p-2 rounded-md bg-red-50 text-red-700 text-sm">Overdue: The Catcher in the Rye</div>
                  <div class="p-2 rounded-md bg-indigo-50 text-indigo-700 text-sm">New reservation: Sapiens</div>
                  <div class="p-2 rounded-md bg-amber-50 text-amber-700 text-sm">Low inventory: 1984</div>
                </div>
              </div>
            </div>

            <!--onclick of the icon this appears-->
            <div class="relative" data-menu-wrap>
              <button class="h-9 w-9 overflow-hidden rounded-full border border-slate-200" data-menu-button="profile">
                <img src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="Profile" class="h-full w-full object-cover" />
              </button>
              <div class="absolute right-0 mt-2 hidden w-44 rounded-xl border border-slate-200 bg-white p-2 shadow-lg" data-menu-panel="profile">
                <a href="./settings.html" class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100">Account Settings</a>
                <a href="./index.html" class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100">Sign Out</a>
              </div>
            </div>

          </div>
        </header>