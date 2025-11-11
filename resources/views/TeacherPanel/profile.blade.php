<x-Teacher-sidebar>

    <main class="flex-1 md:ml-64 p-4 md:p-10 min-w-0 overflow-x-auto">
        <div class="max-w-6xl mx-auto min-w-0">
          <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm mb-6">

            <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>

            <div class="flex items-center justify-between gap-4 relative pl-3 md:pl-4">

              <style> .hero-content { position: relative; z-index: 10; } </style>

              <div class="flex items-center gap-3 hero-content">
                <button id="sidebarToggle" aria-label="Open sidebar" class="md:hidden p-2 bg-indigo-600 text-white rounded"> 
                  <i class="bi bi-list"></i> 
                </button>
                <div class="min-w-0">
                  <h1 class="text-xl md:text-2xl font-bold text-indigo-800">My Profile</h1>
                  <p class="text-sm text-gray-500 mt-1 hidden sm:block">View and edit your profile information</p>
                </div>
              </div>
              <div class="flex-1 text-center">
                <!-- snapshot message intentionally removed on non-homepage pages -->
              </div>
              <div class="flex items-center gap-3 hero-content">
                <div class="text-sm text-gray-500 text-right hidden sm:block">

                  <div class="uppercase tracking-wide text-xs text-gray-400">
                    Today
                  </div>

                  <div class="font-medium">
                    Nov 5, 2025
                  </div>

                </div>

                <!--link to edit profile page-->
                <a href="profile_edit.html" id="editLink" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-sm">
                  Edit Profile
                </a>

              </div>
            </div>
          </header>

  <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">

          <!--checking for teacher object-->
          @if (isset($teacher) && $teacher)
            <!-- use $teacher safely -->
            <div class="bg-white p-6 rounded shadow text-center">      

            <img src="https://www.gravatar.com/avatar/?d=mp&s=128" alt="avatar" class="w-32 h-32 rounded-full mx-auto mb-4" />

            <h2 class="text-xl font-semibold text-indigo-700">
              {{ $teacher->fname }} {{ $teacher->lname }}
            </h2>

            <p class="text-sm text-gray-500">
              Role: Teacher
            </p>

            <div class="mt-6 text-center md:text-left text-sm text-gray-600 space-y-2">
              <div>
                <strong>Email:</strong> 
                <span id="displayEmail">
                  {{ $teacher->email }}
                </span>
              </div>

              <div><strong>Phone:</strong> 
                <span id="displayPhone">
                  {{ $teacher->phone }}
                </span>
              </div>

              <div><strong>Location:</strong>
                <span id="displayLocation">
                  {{ $teacher->city }} {{ $teacher->country }}
                </span></div>
              <div class="mt-4 flex justify-center md:justify-start">
                <button id="changePasswordBtn" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 transition">
                  <i class="bi bi-key-fill text-sm"></i>
                  <span class="text-sm font-medium">Change Password</span>
                </button>
              </div>
            </div>
          </div><!--end of the left side:profile summary-->

          <!-- Profile Details Form -->
          <div class="lg:col-span-2 bg-white p-6 rounded shadow">
  
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Profile Details</h3>

            <form id="profileForm" class="space-y-4">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700">Full name</label>
                  <input id="fullName" 
                  type="text" 
                  class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" value="{{ $teacher->fname }} {{ $teacher->lname }}" disabled />
                </div>

                <div>

                  <label class="block text-sm font-medium text-gray-700">
                    Email
                  </label>

                  <input id="email" 
                  type="email" 
                  class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" 
                  value="{{ $teacher->email }}" disabled />

                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700">
                    Phone
                  </label>

                  <input id="phone" 
                  type="tel" 
                  class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" 
                  value="{{ $teacher->phone }}" disabled />
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700">
                    Location
                  </label>

                  <input id="location" 
                  type="text" 
                  class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" 
                  value="{{ $teacher->city }}, {{ $teacher->country }}" disabled />

                </div>

              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Bio</label>
                <textarea id="bio" rows="4" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" disabled>Experienced class teacher focused on student-centred learning.</textarea>
              </div>

              <div class="flex items-center gap-3">
                <!-- no action buttons in static frontend -->
              </div>
            </form>
          </div>

          <!-- Edit Profile Modal -->

    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">

      <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 sm:mx-6 md:mx-0 overflow-hidden">

        <div class="flex items-center justify-between p-4 bg-indigo-50 border-b">

          <div class="flex items-center gap-3">
            <span class="p-2 bg-indigo-100 text-indigo-700 rounded-lg">
              <i class="bi bi-person-badge-fill"></i>
            </span>
            <h3 class="text-lg font-semibold text-indigo-700">
              Edit Profile
            </h3>
          </div>

          <!--the exit icon button-->
          <button id="modalClose" class="text-indigo-600 hover:text-indigo-800 text-2xl leading-none">
            &times;
          </button>
        </div>

        <!--body of the modal-->
        <div class="p-4 md:p-6">

          <form 
          action="{{ route('teacher.updateprofile') }}"
          method="POST"
          class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>

                <label class="block text-sm font-medium text-gray-700">
                  Phone Number
                </label>

                <input type="tel" 
                autocomplete="name" 
                class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200" 
                name="phone"
                value="{{ $teacher->phone }}" />
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">
                  Email
                </label>
                <input type="email" 
                autocomplete="email" 
                class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200" 
                value="{{ $teacher->email }}" />
              </div>

            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">
                Bio
              </label>

              <textarea rows="4" class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200">
                Experienced class teacher focused on student-centred learning.
              </textarea>
            </div>

            <div class="flex items-center justify-end gap-3">

              <button type="button" id="modalCancel" 
              class="px-4 py-2 rounded-md border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">
                Cancel
              </button>

              <button type="submit" 
              class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-sm hover:from-indigo-700 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-300"> 
              <i class="bi bi-save-fill"></i>
               Save
              </button>

            </div>

          </form>

        </div>

      </div>
    </div>
          

          <!--else statement if no teacher object-->
          @else
          <!-- use $teacher safely -->
            <div class="bg-white p-6 rounded shadow text-center">      

            <img src="https://www.gravatar.com/avatar/?d=mp&s=128" alt="avatar" class="w-32 h-32 rounded-full mx-auto mb-4" />

            <h2 class="text-xl font-semibold text-indigo-700">
              John Doe
            </h2>

            <p class="text-sm text-gray-500">
              Role: Teacher
            </p>

            <div class="mt-6 text-center md:text-left text-sm text-gray-600 space-y-2">
              <div>
                <strong>Email:</strong> 
                <span id="displayEmail">
                  email
                </span>
              </div>

              <div><strong>Phone:</strong> 
                <span id="displayPhone">
                  phone
                </span>
              </div>

              <div><strong>Location:</strong>
                <span id="displayLocation">
                  city,country
                </span></div>
              <div class="mt-4 flex justify-center md:justify-start">
                <button id="changePasswordBtn" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 transition">
                  <i class="bi bi-key-fill text-sm"></i>
                  <span class="text-sm font-medium">Change Password</span>
                </button>
              </div>
            </div>
          </div><!--end of the left side:profile summary-->

          
            <!-- Profile Details Form -->
          <div class="lg:col-span-2 bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Profile Details</h3>
            <form id="profileForm" class="space-y-4">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700">Full name</label>
                  <input id="fullName" type="text" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" value="John Doe" disabled />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Email</label>
                  <input id="email" type="email" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" value="johndoe@example.com" disabled />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Phone</label>
                  <input id="phone" type="tel" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" value="+1 555 0100" disabled />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Location</label>
                  <input id="location" type="text" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" value="City, Country" disabled />
                </div>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Bio</label>
                <textarea id="bio" rows="4" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" disabled>Experienced class teacher focused on student-centred learning.</textarea>
              </div>

              <!-- Editing is disabled in this static version; backend will handle updates -->
              <div class="flex items-center gap-3">
                <!-- no action buttons in static frontend -->
              </div>
            </form>
          </div>

          @endif
  </section>

        <!-- Assigned Classes & Subjects (separate full-width section) -->
        <section class="bg-white p-6 rounded shadow mt-6">
          <h3 class="text-lg font-semibold text-gray-800 mb-4">Assigned Classes & Subjects</h3>

          <div class="mb-4">
            <p class="text-sm text-gray-500">Assignments are managed by the school administrator. You can view your assigned classes and subjects below.</p>
          </div>

          <div id="assignList" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Hardcoded demo assignments -->
            <div class="bg-gray-50 p-4 rounded border">
              <div class="text-sm font-medium">Class 3</div>
              <div class="mt-2"><span class="inline-block bg-indigo-50 text-indigo-700 text-xs px-2 py-1 rounded mr-2">Physics</span><span class="inline-block bg-indigo-50 text-indigo-700 text-xs px-2 py-1 rounded mr-2">Mathematics</span></div>
            </div>
            <div class="bg-gray-50 p-4 rounded border">
              <div class="text-sm font-medium">Class 5</div>
              <div class="mt-2"><span class="inline-block bg-indigo-50 text-indigo-700 text-xs px-2 py-1 rounded mr-2">Biology</span></div>
            </div>
          </div>
        </section>
        </div>
      </main>
    </div>

    <!-- Edit Profile Modal -->

    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">

      <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 sm:mx-6 md:mx-0 overflow-hidden">

        <div class="flex items-center justify-between p-4 bg-indigo-50 border-b">

          <div class="flex items-center gap-3">
            <span class="p-2 bg-indigo-100 text-indigo-700 rounded-lg">
              <i class="bi bi-person-badge-fill"></i>
            </span>
            <h3 class="text-lg font-semibold text-indigo-700">
              Edit Profile
            </h3>
          </div>

          <!--the exit icon button-->
          <button id="modalClose" class="text-indigo-600 hover:text-indigo-800 text-2xl leading-none">
            &times;
          </button>
        </div>

        <!--body of the modal-->
        <div class="p-4 md:p-6">

          <form class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>

                <label class="block text-sm font-medium text-gray-700">
                  Full name
                </label>

                <input type="text" 
                autocomplete="name" 
                class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200" 
                name="fullName"
                value="John Doe" />
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">
                  Email
                </label>
                <input type="email" 
                autocomplete="email" 
                class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200" value="johndoe@example.com" />
              </div>

            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">
                Bio
              </label>

              <textarea rows="4" class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200">
                Experienced class teacher focused on student-centred learning.
              </textarea>
            </div>

            <div class="flex items-center justify-end gap-3">

              <button type="button" id="modalCancel" 
              class="px-4 py-2 rounded-md border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">
                Cancel
              </button>

              <button type="button" 
              class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-sm hover:from-indigo-700 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-300"> 
              <i class="bi bi-save-fill"></i>
               Save
              </button>

            </div>

          </form>

        </div>

      </div>
    </div>

    <!-- Change Password Modal -->
    <div id="pwModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 sm:mx-6 md:mx-0 overflow-hidden">
        <div class="flex items-center justify-between p-4 bg-indigo-50 border-b">
          <div class="flex items-center gap-3">
            <span class="p-2 bg-indigo-100 text-indigo-700 rounded-lg"><i class="bi bi-shield-lock-fill"></i></span>
            <h3 class="text-lg font-semibold text-indigo-700">Change Password</h3>
          </div>
          <button id="pwClose" class="text-indigo-600 hover:text-indigo-800 text-2xl leading-none">&times;</button>
        </div>
        <div class="p-4 md:p-6">
          <form id="pwForm" class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Current password</label>
              <input id="currentPw" type="password" autocomplete="current-password" class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">New password</label>
              <input id="newPw" type="password" autocomplete="new-password" class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200" />
              <p class="text-xs text-gray-400 mt-1">Use at least 8 characters. Include letters and numbers for a stronger password.</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Confirm new password</label>
              <input id="confirmPw" type="password" autocomplete="new-password" class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200" />
            </div>
            <!-- Server-side will handle validation; no client-side messages here -->
            <div class="flex items-center justify-end gap-3">
              <button type="button" id="pwCancel" class="px-4 py-2 rounded-md border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">Cancel</button>
              <button type="button" id="pwSave" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-sm hover:from-indigo-700 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-300"> <i class="bi bi-check-lg"></i> Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      // Modal toggle (UI-only)
      (function(){
        const editBtn = document.querySelector('a[href="profile_edit.html"]');
        const modal = document.getElementById('editModal');
        const close = document.getElementById('modalClose');
        const cancel = document.getElementById('modalCancel');

        function openModal(e){
          e && e.preventDefault();
          modal.classList.remove('hidden');
          modal.classList.add('flex');
        }
        function closeModal(){
          modal.classList.add('hidden');
          modal.classList.remove('flex');
        }

        if(editBtn) editBtn.addEventListener('click', openModal);
        if(close) close.addEventListener('click', closeModal);
        if(cancel) cancel.addEventListener('click', closeModal);

        // close modal on backdrop click
        modal.addEventListener('click', (e)=>{ if(e.target === modal) closeModal(); });
      })();


      // Change password modal (UI-only)
      (function(){
        const btn = document.getElementById('changePasswordBtn');
        const pwModal = document.getElementById('pwModal');
        const pwClose = document.getElementById('pwClose');
        const pwCancel = document.getElementById('pwCancel');
        const pwSave = document.getElementById('pwSave');
        const pwMsg = document.getElementById('pwMsg');
        const newPw = document.getElementById('newPw');
        const confirmPw = document.getElementById('confirmPw');

        function open(){ pwModal.classList.remove('hidden'); pwModal.classList.add('flex'); pwMsg.textContent=''; }
        function close(){ pwModal.classList.add('hidden'); pwModal.classList.remove('flex'); pwMsg.textContent=''; }

        if(btn) btn.addEventListener('click', (e)=>{ e.preventDefault(); open(); });
        if(pwClose) pwClose.addEventListener('click', close);
        if(pwCancel) pwCancel.addEventListener('click', close);
        pwModal && pwModal.addEventListener('click', (e)=>{ if(e.target === pwModal) close(); });

        if(pwSave) pwSave.addEventListener('click', ()=>{
          // no client-side validation here; backend handles checks
          newPw.value = '';
          confirmPw.value = '';
          document.getElementById('currentPw').value = '';
          close();
        });

      })();
    </script>

</x-Teacher-sidebar>