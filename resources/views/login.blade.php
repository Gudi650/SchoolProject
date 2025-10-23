<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
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
      <form action="{{ route('login') }}" method="POST" class="space-y-4">

        @csrf

        <h3 class="text-xl font-semibold">Sign in to your account</h3>

        {{-- show general errors (e.g. credentials) --}}
        @if ($errors->any())
          <div class="bg-red-100 text-red-700 p-2 rounded">
            <ul class="list-disc list-inside">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <div>
          <label class="text-sm font-medium">Email address</label>

          <input 
          type="email" 
          required 
          class="w-full mt-1 p-2 border rounded" 
          placeholder="student@example.com" 
          name="email"
          value = "{{ old('email') }}"
          />
          @error('email')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror

        </div>
        <div>
          <label class="text-sm font-medium">Password</label>
          <div class="relative">

            <input 
            class="w-full mt-1 p-2 border rounded"
            id="loginPassword" 
            type="password" 
            name="password"
            required 
            />
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <button type="button" id="toggleLoginPassword" class="absolute right-2 top-2 text-gray-500"><i class="fa fa-eye"></i></button>
          </div>
        </div>
        <div class="flex items-center justify-between">

          <a href="#" class="text-indigo-600 text-sm">Forgot password?</a>

          <a href="{{ route('showsignup') }}" id="showSignUp" class="text-sm">
            Create account
        </a>

        </div>
        <button class="w-full bg-indigo-600 text-white py-2 rounded">
            Sign in
        </button>
      </form>

    </div>
  </div>

  <script>

    //toogle the password

    const t1 = document.getElementById('toggleLoginPassword'); 
    const lp = document.getElementById('loginPassword'); 
    t1.addEventListener('click', () => { lp.type = lp.type === 'password' ? 'text' : 'password'; t1.innerHTML = lp.type === 'password' ? '<i class="fa fa-eye"></i>' : '<i class="fa fa-eye-slash"></i>'; });

  </script>

  

</body>
</html>