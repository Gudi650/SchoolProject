<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SignUp</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-4xl bg-white rounded-xl shadow overflow-hidden flex">
    <div class="hidden md:block md:w-1/2 bg-indigo-600 text-white p-10">
      <div class="text-2xl font-bold mb-6">SchoolPortal</div>
      <h2 class="text-3xl font-bold leading-tight">Welcome to<br/>your learning<br/>journey</h2>
      <p class="mt-4 text-indigo-200">Access your courses, assignments, grades and connect with teachers and classmates in one place.</p>
    </div>
    <div class="w-full md:w-1/2 p-8">

      <form action="{{ route('signup') }}" method="POST" class="space-y-4 mt-6 ">

        @csrf

        <h3 class="text-xl font-semibold">Create your account</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
          
          <input 
          class="p-2 border rounded" 
          placeholder="First name" 
          name = "fname"
          value = "{{ old('fname') }}"
          required
          />

          <input 
          class="p-2 border rounded" 
          placeholder="Last name" 
          name = "lname"
          value = "{{ old('lname') }}"
          required
          />

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
          
          <select name="role" 
          class="p-2 border rounded"
           required>
            <option value="">Select Your Role:</option>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
            <option value="admin">Admin</option>
          </select>

          <!--check school from database-->
          <!--check if the $school variable is passed from the controller-->

          @if (isset($schools) &&$schools->isNotEmpty()) 
            
            <select 
            name="school_id" 
            class="p-2 border rounded"
           required>

            <option value="">Select Your School:</option>
            <!--loop through th schools -->
            @foreach ( $schools as $school )

              <option value = "{{ $school->id }}" >
                 {{ $school->name }}
              </option>
              
            @endforeach

            </select>

          @endif

          

        </div>

        <input 
        class="w-full p-2 border rounded" 
        placeholder="Email" 
        name = "email"
        value = "{{ old('email') }}"
        required
        />

        <input 
        class="w-full p-2 border rounded" 
        placeholder="Verify Email" 
        name = "email_confirmation"
        required
        />

        <div class="relative">

          <input id="signupPassword" 
          type="password" 
          class="w-full p-2 border rounded" 
          placeholder="password" 
          name="password"
          />

          <button type="button" id="toggleSignupPassword" class="absolute right-2 top-2 text-gray-500"><i class="fa fa-eye"></i></button>

        </div>

        <div class="relative">

          <input id="signupPassword" 
          type="password" 
          class="w-full p-2 border rounded" 
          placeholder="password_confirmation"
          name="password_confirmation"
          required 
          />

          <button type="button" id="toggleSignupPassword" class="absolute right-2 top-2 text-gray-500"><i class="fa fa-eye"></i></button>

        </div>

        <button class="w-full bg-indigo-600 text-white py-2 rounded">
          Create account
        </button>

        <div class="text-center text-sm">
          Already have an account? 
          <a href="{{ route('showlogin') }}" id="showLogin">Sign in</a>
        </div>
        
      </form>

      <!--showing the errors-->
      <div class="mt-4">
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      </div>

    </div>
  </div>

  <script>

    //toogle the password

    const t2 = document.getElementById('toggleSignupPassword');
     const sp = document.getElementById('signupPassword'); 
     t2?.addEventListener('click', () => { sp.type = sp.type === 'password' ? 'text' : 'password'; t2.innerHTML = sp.type === 'password' ? '<i class="fa fa-eye"></i>' : '<i class="fa fa-eye-slash"></i>'; });

  </script>

</body>
</html>