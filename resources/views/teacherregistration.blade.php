<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Teacher Registration — Teacher Portal</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">

    <style>
      :root{ --brand-500:#4f46e5; --brand-600:#4338ca; --brand-50:#eef2ff; }
      .tc-avatar{ width:28px; height:28px; border-radius:9999px; display:inline-flex; align-items:center; justify-content:center; font-weight:600; background:var(--brand-50); color:var(--brand-600); border:1px solid rgba(79,70,229,0.08); font-size:12px; }
      .tc-chip{ display:inline-flex; align-items:center; gap:.5rem; padding:.25rem .5rem; background:rgba(79,70,229,0.06); border:1px solid rgba(79,70,229,0.08); border-radius:9999px; font-size:13px; color:#0f172a; }
      /* subtle accent for the form card */
      .form-accent { background: linear-gradient(180deg, #ffffff 0%, rgba(79,70,229,0.02) 100%); border-left:4px solid rgba(79,70,229,0.12); }
      .btn-indigo-gradient { background: linear-gradient(90deg,var(--brand-500),var(--brand-600)); }
    </style>

  </head>
  <body class="bg-gray-50 text-gray-800 min-h-screen">

    <div class="max-w-3xl mx-auto p-6">
      <div class="bg-white rounded-lg shadow p-6">

        <h1 class="text-2xl font-semibold mb-2 text-indigo-700">
          Teacher Registration
        </h1>
        
        <p class="text-sm text-gray-500 mb-4">
          Please provide your professional details to create an account.
        </p>

        <div class="flex items-center gap-4 mb-4">

          <div class="w-full bg-gray-200 rounded h-1.5 overflow-hidden">
            <div id="progressInner" class="bg-indigo-600 h-1.5 w-full"></div>
          </div>

          <div class="flex gap-2">
            <div class="w-2.5 h-2.5 rounded-full bg-indigo-600"></div>
            <div class="w-2.5 h-2.5 rounded-full bg-indigo-600"></div>
          </div>

        </div>

        <form 
        action="{{ route('teacherregistration') }}"
        method="POST"
        autocomplete="off"
        id="registerForm" 
        class="space-y-4" 
        novalidate
        >

        @csrf
          <!-- Personal section -->
          <div class="bg-indigo-50 p-4 rounded mb-4">
            <h2 class="text-indigo-700 font-semibold mb-3">Personal information</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>

                <label 
                for="firstName" 
                class="block text-sm font-medium text-gray-700">
                  First name
                </label>

                <input id="firstName" 
                name="fname" 
                value="{{ old('fname') }}"
                required 
                class="mt-1 block w-full rounded-md border-gray-200 px-3 py-2 shadow-sm focus:ring-indigo-400 focus:border-indigo-400" />
              </div>
              <div>
                <label for="middleName" 
                  class="block text-sm font-medium text-gray-700">
                  Middle name
                </label>

                <input id="middleName" 
                name="mname" 
                value="{{ old('mname') }}"
                class="mt-1 block w-full rounded-md border-gray-200 px-3 py-2 shadow-sm focus:ring-indigo-400 focus:border-indigo-400" />

              </div>

              <div>
                <label for="lastname" 
                class="block text-sm font-medium text-gray-700">
                Last name
                </label>

                <input id="lastName" 
                name="lname" 
                value = "{{ old('lname') }}"
                required 
                class="mt-1 block w-full rounded-md border-gray-200 px-3 py-2 shadow-sm focus:ring-indigo-400 focus:border-indigo-400" />
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>

                <label for="email" 
                class="block text-sm font-medium text-gray-700">
                  Email address
                </label>

                <input id="email" 
                name="email" 
                value = "{{ old('email') }}"
                type="email" 
                required 
                class="mt-1 block w-full rounded-md border-gray-200 px-3 py-2 shadow-sm focus:ring-indigo-400 focus:border-indigo-400" />

              </div>

              <div>
                <label for="phone" 
                class="block text-sm font-medium text-gray-700">
                  Phone
               </label>

                <input id="phone" 
                name="phone" 
                value = "{{ old('phone') }}"
                type="tel" 
                class="mt-1 block w-full rounded-md border-gray-200 px-3 py-2 shadow-sm focus:ring-indigo-400 focus:border-indigo-400" />

              </div>

              <div>
                <label 
                  for="gender" 
                  class="block text-sm font-medium text-gray-700">
                  Gender
                </label>

                <select id="gender" 
                name="gender" 
                class="mt-1 block w-full rounded-md border-gray-200 px-3 py-2 shadow-sm focus:ring-indigo-400 focus:border-indigo-400">

                  <option value="">
                    Select gender
                  </option>
                  <option value = "male">Male</option>
                  <option value = "female">Female</option>
                </select>

              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div class="md:col-span-2">

                <label for="subjectsDropdown" 
                class="block text-sm font-medium text-gray-700">
                  Subjects / Specialties
                </label>

                <div id="subjectsDropdown" class="relative mt-1">

                  <button id="subjectsToggle" 
                  type="button" 
                  class="w-full text-left border border-gray-200 rounded-md px-3 py-2 flex items-center justify-between focus:outline-none focus:ring-2 focus:ring-indigo-400" aria-expanded="false"> 

                    <span id="subjectsLabel" class="text-sm text-gray-700">Select subjects</span>
                    <i class="bi bi-chevron-down text-gray-400"></i>

                  </button>

                  <div id="subjectsMenu" 
                  class="hidden absolute left-0 right-0 mt-2 bg-white border border-gray-200 rounded-md shadow max-h-48 overflow-auto z-40">

                    <!-- list of common subjects -->
                    <label class="flex items-center gap-2 p-2 hover:bg-indigo-50 cursor-pointer">
                      <input type="checkbox" class="subject-option" 
                      name = "subject_specialization"
                      value="Mathematics">
                      <span class="text-sm">
                        Mathematics
                      </span>
                    </label>

                    <label class="flex items-center gap-2 p-2 hover:bg-indigo-50 cursor-pointer">
                      <input type="checkbox" class="subject-option"
                        name = "subject_specialization"
                        value="English">
                      <span class="text-sm">
                        English
                      </span>
                    </label>

                    <label class="flex items-center gap-2 p-2 hover:bg-indigo-50 cursor-pointer">
                      <input type="checkbox" class="subject-option" 
                      name = "subject_specialization"
                      value="Science">
                      <span class="text-sm">
                        Science
                      </span>
                    </label>

                    <label class="flex items-center gap-2 p-2 hover:bg-indigo-50 cursor-pointer">
                      <input type="checkbox" class="subject-option"
                      name = "subject_specialization"
                      value="History">
                      <span class="text-sm">
                        History
                      </span>
                    </label>

                    <label class="flex items-center gap-2 p-2 hover:bg-indigo-50 cursor-pointer">
                      <input type="checkbox" class="subject-option"
                      name = "subject_specialization"
                      value="Geography">
                      <span class="text-sm">
                        Geography
                      </span>
                    </label>

                    <label class="flex items-center gap-2 p-2 hover:bg-indigo-50 cursor-pointer">
                      <input type="checkbox" class="subject-option"
                      name = "subject_specialization"
                      value="Computer Science">
                      <span class="text-sm">
                        Computer Science
                      </span>
                    </label>

                    <label class="flex items-center gap-2 p-2 hover:bg-indigo-50 cursor-pointer">
                      <input type="checkbox" class="subject-option"
                      name = "subject_specialization"
                      value="Art">
                      <span class="text-sm">
                        Art
                      </span>
                    </label>

                  </div>
                </div>
                <div id="selectedSubjects" class="mt-2 flex flex-wrap gap-2"></div>
              </div>

              <div>
                <label for="experience" class="block text-sm font-medium text-gray-700">
                  Years experience
                </label>

                <input id="experience" 
                name="experience" 
                type="number" 
                min="0" 
                class="mt-1 block w-full rounded-md border-gray-200 px-3 py-2 shadow-sm focus:ring-indigo-400 focus:border-indigo-400"/>

              </div>
            </div>

            <!--for qualification-->
            <div>
              <label for="qualification" class="block text-sm font-medium text-gray-700">
                Qualification
              </label>

               <select name="qualification" id="qualification"
                class="mt-1 block w-full rounded-md border-gray-200 px-3 py-2 shadow-sm focus:ring-indigo-400 focus:border-indigo-400"
               required>
                <option value="">Select qualification</option>
                <option value="bachelor">Bachelor's Degree</option>
                <option value="master">Master's Degree</option>
                <option value="phd">Ph.D.</option>
              </select>
            </div>

            

            <div class="flex items-center gap-4">
              <label class="block text-sm font-medium text-gray-700">Profile photo</label>
              <div class="flex items-center gap-3">
                <input id="photoInput" type="file" accept="image/*" class="hidden" />
                <button id="photoBtn" type="button" class="px-3 py-2 bg-white border rounded-md text-sm border-gray-200 hover:bg-indigo-50 shadow-sm">Upload</button>
                <div id="photoPreview" class="h-14 w-14 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden border border-gray-200">
                  <i class="bi bi-person text-2xl text-gray-400"></i>
                </div>
              </div>
            </div>

            <div class="flex items-center justify-between gap-4">
              <div id="formErrors" class="text-sm text-red-600"></div>
              <div class="ml-auto flex items-center gap-3">

                <button type="reset" 
                  class="px-4 py-2 bg-white border rounded-md text-sm border-gray-200 hover:bg-gray-50">
                  Reset
                </button>

                <button id="submitBtn" 
                  type="submit" 
                  class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
                  Create account
                </button>

              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="max-w-3xl mx-auto p-6">
        <div id="successToast" class="fixed right-6 bottom-6 hidden bg-white border border-green-100 shadow-lg rounded-lg px-4 py-3 flex items-center gap-3">
          <div class="h-8 w-8 rounded-full bg-green-50 flex items-center justify-center text-green-600"><i class="bi bi-check-lg"></i></div>
          <div class="text-sm text-green-700">Registration complete (UI demo)</div>
        </div>
      </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function(){
      // Subjects dropdown
      const subjectsToggle = document.getElementById('subjectsToggle');
      const subjectsMenu = document.getElementById('subjectsMenu');
      const subjectsLabel = document.getElementById('subjectsLabel');
      const subjectOptions = Array.from(document.querySelectorAll('.subject-option'));
      const selectedSubjects = document.getElementById('selectedSubjects');

      function updateSubjectsLabel(){
        const sel = subjectOptions.filter(o => o.checked).map(o => o.value);
        if(sel.length === 0) subjectsLabel.textContent = 'Select subjects';
        else if(sel.length === 1) subjectsLabel.textContent = sel[0];
        else subjectsLabel.textContent = sel.length + ' subjects';
      }

      function renderSubjectChips(){
        selectedSubjects.innerHTML = '';
        subjectOptions.filter(o=>o.checked).forEach(o=>{
          const chip = document.createElement('span'); chip.className='tc-chip';
          const initials = o.value.split(' ').map(s=>s[0]||'').slice(0,2).join('').toUpperCase();
          const av = document.createElement('span'); av.className='tc-avatar'; av.textContent = initials;
          const lbl = document.createElement('span'); lbl.textContent = o.value;
          const remove = document.createElement('button'); remove.type='button'; remove.className='ml-2 text-xs text-gray-400 hover:text-red-500'; remove.innerHTML='✕';
          remove.addEventListener('click', ()=>{ o.checked = false; updateSubjectsLabel(); renderSubjectChips(); });
          chip.appendChild(av); chip.appendChild(lbl); chip.appendChild(remove);
          selectedSubjects.appendChild(chip);
        });
      }

      subjectsToggle.addEventListener('click', function(e){ e.preventDefault(); subjectsMenu.classList.toggle('hidden'); const exp = subjectsToggle.getAttribute('aria-expanded') === 'true'; subjectsToggle.setAttribute('aria-expanded', (!exp).toString()); });
      document.addEventListener('click', function(e){ if(!document.getElementById('subjectsDropdown').contains(e.target)){ subjectsMenu.classList.add('hidden'); subjectsToggle.setAttribute('aria-expanded','false'); } });
      subjectOptions.forEach(cb => cb.addEventListener('change', ()=>{ updateSubjectsLabel(); renderSubjectChips(); }));

      // Photo upload + preview
      const photoBtn = document.getElementById('photoBtn');
      const photoInput = document.getElementById('photoInput');
      const photoPreview = document.getElementById('photoPreview');
      photoBtn.addEventListener('click', ()=> photoInput.click());
      photoInput.addEventListener('change', function(){
        const file = this.files && this.files[0];
        if(!file) return;
        const url = URL.createObjectURL(file);
        photoPreview.innerHTML = '';
        const img = document.createElement('img'); img.src = url; img.alt = 'Profile'; img.className='object-cover h-full w-full';
        photoPreview.appendChild(img);
      });

      
      // Password visibility toggles
      const togglePassword = document.getElementById('togglePassword');
      const togglePasswordIcon = document.getElementById('togglePasswordIcon');
      const toggleConfirm = document.getElementById('toggleConfirm');
      const toggleConfirmIcon = document.getElementById('toggleConfirmIcon');
      function toggleInputVisibility(inputEl, iconEl, btn){
        if(!inputEl || !iconEl || !btn) return;
        const showing = inputEl.getAttribute('type') === 'text';
        if(showing){
          inputEl.setAttribute('type','password');
          iconEl.className = 'bi bi-eye';
          btn.setAttribute('aria-pressed','false');
        } else {
          inputEl.setAttribute('type','text');
          iconEl.className = 'bi bi-eye-slash';
          btn.setAttribute('aria-pressed','true');
        }
      }
      if(togglePassword) togglePassword.addEventListener('click', ()=> toggleInputVisibility(password, togglePasswordIcon, togglePassword));
      if(toggleConfirm) toggleConfirm.addEventListener('click', ()=> toggleInputVisibility(confirmPassword, toggleConfirmIcon, toggleConfirm));

      function showToast(){ toast.classList.remove('hidden'); setTimeout(()=> toast.classList.add('hidden'), 2800); }

      
    });
    </script>
  </body>
</html>
