<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Parent Registration</title>

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

      <p class="text-sm text-gray-600 mb-6">Please provide the Parent's personal information</p>

      <div id="messages" class="mb-4"></div>


      <form  
      action = "{{ route('parentregistration') }}"
      method = "POST"
      autocomplete="off" 
      class="space-y-6 bg-white mt-6">

        @csrf

        <div class="border rounded p-4">
          <div class="text-lg font-medium mb-3">Parent/Guardian Information</div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>

              <label class="block text-sm text-gray-600 mb-1">
                First Name
            </label>
              <input id="parentFirstName" 
              name="fname" 
              class="w-full p-2 border rounded" 
              required />

            </div>
            <div>
              <label class="block text-sm text-gray-600 mb-1">
                Middle Name
            </label>

              <input id="parentMiddleName" 
              name="mname" 
              class="w-full p-2 border rounded" />

            </div>
            <div>
              <label class="block text-sm text-gray-600 mb-1">
                Last Name
            </label>
              <input id="parentLastName" 
              name="lname" 
              class="w-full p-2 border rounded" 
              required 
              />

            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
              <label class="block text-sm text-gray-600 mb-1">
                Gender
            </label>

              <select id="parentGender" 
              name="gender" 
              class="w-full p-2 border rounded" 
              required>

                <option value="">Select gender</option>
                <option value= "male">Male</option>
                <option value= "female">Female</option>
              </select>
            </div>
            <div>

              <label class="block text-sm text-gray-600 mb-1">Phone Number</label>
              <input id="parentPhone" 
              name="phone" 
              type="tel" 
              class="w-full p-2 border rounded" 
              placeholder="(255) 456-7890" 
              required />

            </div>
            <div>
              <label class="block text-sm text-gray-600 mb-1">Email Address</label>
              <input id="parentEmail" 
              name="email" 
              type="email" 
              class="w-full p-2 border rounded" 
              placeholder="email@example.com"
              required />
              <span class="text-xs text-gray-500">We'll never share your email with anyone else.</span>
            </div>
          </div>

          <div class="mt-4">
            <label class="block text-sm text-gray-600 mb-1">Relationship to Student</label>
            <select id="relationship" name="rtnship" class="w-full p-2 border rounded" required>
              <option value="">Select relationship</option>
              <option value ="mother" >Mother</option>
              <option value ="father" >Father</option>
              <option value ="guardian" >Guardian</option>
              <option value ="other" >Other</option>
            </select>
          </div>
        </div>

        <div class="border rounded p-4">
          <div class="text-lg font-medium mb-3">Parent/Guardian Address</div>
          <div class="mb-3">
            <label class="inline-flex items-center"><input id="sameAsStudent" type="checkbox" class="mr-2"> <span class="text-sm text-gray-600">Same as student address</span></label>
          </div>

          <div>
            <label class="block text-sm text-gray-600 mb-1">
                Street Address
            </label>
            <input id="parentStreet" 
            name="street" class="w-full p-2 border rounded" />
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
              <label class="block text-sm text-gray-600 mb-1">Ward</label>
              <input id="parentCity" name="ward" class="w-full p-2 border rounded"  />
            </div>
            <div>
              <label class="block text-sm text-gray-600 mb-1">District</label>
              <input id="parentState" name="district" class="w-full p-2 border rounded"  />
            </div>
            <div>
              <label class="block text-sm text-gray-600 mb-1">City</label>
              <input id="parentZip" name="city" class="w-full p-2 border rounded" required />
            </div>
          </div>
        </div>

        <div class="flex gap-4">

          <button type="button" 
          class="flex-1 px-4 py-2 border border-indigo-600 text-indigo-600 font-semibold rounded"
          >
            <a href = "{{ route('showstudentregistration') }}">
            Back to Student Information
            </a>
        </button>
          

          <button id="submitRegistration" type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded">
            Submit Registration
        </button>

        <!--checking if there are any errors-->
        
        @if ($errors->any())
            <div class="mt-4 p-4 bg-red-100 text-red-700">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif

        </div>
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