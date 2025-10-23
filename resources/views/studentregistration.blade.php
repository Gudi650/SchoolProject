<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Student Registration</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">

  <style>body{font-family:Inter,ui-sans-serif,system-ui,-apple-system,'Segoe UI',Roboto,'Helvetica Neue',Arial}</style>

</head>

<body class="bg-gray-50 text-gray-800 min-h-screen">
  <div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow p-6">
      <div class="text-2xl font-semibold mb-2">Student Registration</div>
      <div class="mb-6">
        <div class="h-2 bg-gray-200 rounded overflow-hidden">
          <div id="progressInner" class="h-2 bg-indigo-600 w-1/2"></div>
        </div>
        <div class="flex items-center gap-2 mt-3">
          <div class="w-3 h-3 rounded-full bg-indigo-600"></div>
          <div class="w-3 h-3 rounded-full bg-gray-300"></div>
        </div>
      </div>

      <p class="text-sm text-gray-600 mb-6">Please provide the student's personal information</p>

      <div id="messages" class="mb-4"></div>

      <form 
       action = "{{ route('studentregistration') }}"
       method= "POST"
       autocomplete="off" 
       class="space-y-6 bg-white">

        @csrf

        <div class="border rounded p-4">
          <div class="text-lg font-medium mb-3">Student Information</div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm text-gray-600 mb-1" for="firstName">First Name</label>

              <input id="firstName" 
              name="fname"
              value="{{ old('fname') }}" 
              required 
              class="w-full p-2 border rounded" 
              placeholder="First name" />

            </div>
            <div>
              <label class="block text-sm text-gray-600 mb-1" for="middleName">Middle Name</label>

              <input id="middleName" 
              name="mname" 
              value="{{ old('mname') }}"
              required 
              class="w-full p-2 border rounded" 
              placeholder="Middle name" />
            </div>
            <div>
              <label class="block text-sm text-gray-600 mb-1" for="lastName">Last Name</label>

              <input id="lastName" 
              name="lname" 
              value="{{ old('lname') }}"
              required 
              class="w-full p-2 border rounded" 
              placeholder="Last name" />
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>

              <label class="block text-sm text-gray-600 mb-1">Gender</label>

              <select id="gender" 
              name="gender"
              value = "{{ old('gender') }}" 
              required 
              class="w-full p-2 border rounded">

                <option value="">Select gender</option>
                <option value = "male">Male</option>
                <option value = "female">Female</option>
              </select>
            </div>
            
            <div>

              <label class="block text-sm text-gray-600 mb-1">
                Class/Grade
              </label>

              <select id="classGrade" 
              name="class" 
              value = "{{ old('class') }}"
              required 
              class="w-full p-2 border rounded"
              >
                <option value="">Select class</option>
                <option value="Grade 1">Grade 1</option>
                <option value="Grade 2">Grade 2</option>
                <option value="Grade 3">Grade 3</option>
                <option value="Grade 4">Grade 4</option>
                <option value="Grade 5">Grade 5</option>
                <option value="Grade 6">Grade 6</option>
                <option>Grade 7</option>

              </select>
            </div>
            <div>
              <label class="block text-sm text-gray-600 mb-1">
                Date of Birth
              </label>

              <input id="dob" 
              type="date" 
              name="date_of_birth" 
              value="{{ old('date_of_birth') }}"
              required 
              class="w-full p-2 border rounded" />

            </div>
          </div>
        </div>

        <div class="border rounded p-4">
          <div class="text-lg font-medium mb-3">Student Address</div>
          <div>
            <label class="block text-sm text-gray-600 mb-1">
              Street Address
            </label>
            <input id="street" name="street" class="w-full p-2 border rounded" placeholder="Street address"/>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
              <label class="block text-sm text-gray-600 mb-1">Ward</label>
              <input id="city" name="ward" class="w-full p-2 border rounded" placeholder="Ward"/>
            </div>
            <div>
              <label class="block text-sm text-gray-600 mb-1">District</label>
              <input id="state" name="district" class="w-full p-2 border rounded" placeholder="District"/>
            </div>
            <div>
              <label class="block text-sm text-gray-600 mb-1">City</label>
              <input id="zip" name="city" class="w-full p-2 border rounded" placeholder="City"/>
            </div>
          </div>
        </div>

        <div class="flex">

          <button 
          type="submit" 
          class="ml-auto px-4 py-2 bg-indigo-600 text-white rounded">
          Continue to Parent Information
        </button>
        </div>

        <!--checking for errors-->
        @if ($errors->any())
          <div class="mt-4 text-red-600">
            <ul class="list-disc list-inside">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

      </form>

      <div class="mt-4 text-xs text-gray-500">Note: This is a frontend-only mockup. To persist data, wire these forms to your backend endpoints.</div>
    </div>
  </div>

  <script>

    // small responsive behavior: adjust initial progress bar width
    window.addEventListener('load', () => { progressInner.style.width = '50%'; });

  </script>
</body>
</html>