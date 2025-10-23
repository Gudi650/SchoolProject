<x-Student-sidebar>

     <main class="flex-1 md:ml-64 p-6 md:p-10">
      <header class="flex items-center justify-between bg-white p-4 rounded-lg shadow mb-6">
        <div class="flex items-center gap-4">
          <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"> <i class="bi bi-list"></i> </button>
          <h1 class="text-xl font-medium">Home</h1>
        </div>
        <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded">Edit Profile</a>
      </header>

      <div class="content bg-white rounded shadow">
        <div class="contentHeading flex items-center p-8 border-b border-gray-100 bg-indigo-50">
          <div class="image mr-4">
            <img src="../StudentPanel/image.png" alt="avatar" class="h-24 w-24 rounded-full object-cover ring-2 ring-white">
          </div>
          <div class="info">
            <!--checking if there is a student object-->
            @if ($student)
              <h2 class="text-lg font-bold">{{ $student->fname }} {{ $student->lname }}</h2>
              <p class="text-sm text-gray-500">Class: {{ $student->class }}</p>
              <p class="text-sm text-gray-500">Admission No: {{ $student->id }}</p>
            @else
              <h2 class="text-lg font-bold">Student Name</h2>
              <p class="text-sm text-gray-500">Class: N/A</p>
              <p class="text-sm text-gray-500">Admission No: N/A</p>
            @endif
          </div>
        </div>

        <div class="mainContent p-6 flex flex-col md:flex-row gap-6">
          
            <div class="leftContent flex-1 space-y-4">

              <p class="text-indigo-600 font-medium">
                Personal Information
              </p>

              <!-- Each item enclosed separately to match original PHP layout -->

              <div class="space-y-3">
                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded border">
                  <i class="bi bi-person text-indigo-600 text-2xl p-2 rounded-full bg-blue-50 flex-shrink-0"></i>
                  <div>
                    <p class="text-sm text-gray-500">Full name</p>
                    <p class="font-medium">{{ $student ? $student->fname .' ' . $student->mname .' '. $student->lname : 'Student Name' }}</p>
                  </div>
                </div>

                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded border">
                  <i class="bi bi-person text-indigo-600 text-2xl p-2 rounded-full bg-blue-50 flex-shrink-0"></i>
                  <div>
                    <p class="text-sm text-gray-500">Gender</p>
                    <p class="font-medium">
                      {{ $student ? $student->gender : '' }}
                    </p>
                  </div>
                </div>

                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded border">
                  <i class="bi bi-calendar-check text-indigo-600 text-2xl p-2 rounded-full bg-blue-50 flex-shrink-0"></i>
                  <div>
                    <p class="text-sm text-gray-500">Date_of_Birth</p>
                    <p class="font-medium">
                      {{ $student ? $student->date_of_birth : '2008-08-15' }}
                    </p>
                  </div>
                </div>

                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded border">
                  <i class="bi bi-geo-alt text-indigo-600 text-2xl p-2 rounded-full bg-blue-50 flex-shrink-0"></i>
                  <div>
                    <p class="text-sm text-gray-500">Address</p>
                    <p class="font-medium">
                      @if($student->district || $student->city)
                          {{ trim(($student->district ? $student->district : '') . ($student->district && $student->city ? ', ' : '') . ($student->city ? $student->city : '')) }}
                      @else
                          District, City
                      @endif
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="rightContent flex-1 space-y-4">
              <p class="text-indigo-600 font-medium">Parents Information</p>
              <div class="space-y-3">
                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded border">
                  <i class="bi bi-person text-indigo-600 text-2xl p-2 rounded-full bg-blue-50 flex-shrink-0"></i>

                  <div>

                    <p class="text-sm text-gray-500">Full name</p>
                    <p class="font-medium">
                      {{ $parent ? $parent->fname .' ' . $parent->mname .' '. $parent->lname : 'Jane Doe' }}</p>
                  </div>

                </div>

                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded border">
                  <i class="bi bi-person text-indigo-600 text-2xl p-2 rounded-full bg-blue-50 flex-shrink-0"></i>
                  <div>
                    <p class="text-sm text-gray-500">Gender</p>
                    <p class="font-medium">
                      {{ $parent->gender ? $parent->gender : 'Not given' }}
                    </p>
                  </div>
                </div>

                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded border">
                  <i class="bi bi-telephone text-indigo-600 text-2xl p-2 rounded-full bg-blue-50 flex-shrink-0"></i>
                  <div>
                    <p class="text-sm text-gray-500">Contact</p>
                    <p class="font-medium">
                      {{ $parent->phone ? $parent->phone : '' }}
                    </p>
                  </div>
                </div>

                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded border">
                  <i class="bi bi-geo-alt text-indigo-600 text-2xl p-2 rounded-full bg-blue-50 flex-shrink-0"></i>
                  <div>
                    <p class="text-sm text-gray-500">Address</p>
                    <p class="font-medium">
                      @if($parent->district || $parent->city)
                          {{ trim(($parent->district ? $parent->district : '') . ($parent->district && $parent->city ? ', ' : '') . ($parent->city ? $parent->city : '')) }}
                      @else
                          District, City
                      @endif
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

      </div>

    </main>

</x-Student-sidebar>