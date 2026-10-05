<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\User;
use App\Services\AccountantContextService;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private AccountantContextService $accountantContext)
    {
    }

    private function redirectAfterLogin(User $user)
    {
        $this->accountantContext->syncSchoolSession($user);

        if ($user->roles === 'teacher') {
            return redirect()->route('teacher.dashboard');
        }

        if ($user->roles === 'student') {
            return redirect()->route('student.homepage');
        }

        if ($user->roles === 'accountant') {
            if ($this->accountantContext->resolveSchoolIdForUser($user)) {
                return redirect()->route('accounting.dashboard');
            }

            return redirect()
                ->route('showteacherregistration')
                ->with('info', 'Link your school profile to access the finance dashboard.');
        }

        if ($user->roles === 'librarian') {
            return redirect()->route('library.dashboard');
        }

        return redirect()->route('student.homepage');
    }

    private function redirectAfterSignup(User $user)
    {
        $this->accountantContext->syncSchoolSession($user);

        if ($user->roles === 'teacher') {
            return redirect()->route('showteacherregistration');
        }

        if ($user->roles === 'student') {
            return redirect()->route('studentregistration');
        }

        if ($user->roles === 'librarian') {
            return redirect()->route('showteacherregistration');
        }

        if ($user->roles === 'accountant') {
            if ($this->accountantContext->resolveSchoolIdForUser($user)) {
                return redirect()->route('accounting.dashboard');
            }

            return redirect()->route('showteacherregistration');
        }

        return redirect()->route('studentregistration');
    }

    //showing the login page
    public function showLogin()
    {
        return view('login');
    }

    //showing the signup page
    public function showSignUp()
    {

        //pass data to the signup view
        //get the available schools registered in the system
        $schools = School::all();

        //pass the schools data to the signup view

        return view('signup',['schools' => $schools]);
    }

    //handling login form submission
    public function login(Request $request)
    {
        //validate the data
        $validatedData = $request-> validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        //attempt login
        $successlogin =  Auth::attempt($validatedData);

        //checking for successful login
        if($successlogin){

            //regenerate session cookies
            $request->session()->regenerate();

            return $this->redirectAfterLogin(Auth::user());
        }

        //if login fails, redirect back with an error message
        throw ValidationException::withMessages([
            'credentials' => ['The provided credentials are incorrect.'],
        ]);
    }

    //handling signup form submission
    public function signup(Request $request)
    {
        //validate the input data
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'role' => 'required|string|in:student,teacher,admin,librarian,accountant',
            'email' => 'required|email|unique:users,email',
            'email_confirmation' => 'required|same:email',
            'password' => 'required|string|min:8|confirmed',
            'school_id' => 'required|exists:schools,id',
        ]);

        session()->put('school_id', $validatedData['school_id']);

        //create user in the database
        $user = User::create([
            'fname' => $validatedData['fname'],
            'lname' => $validatedData['lname'],
            'roles' => $validatedData['role'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        //login the user 
        Auth::login($user);

        return $this->redirectAfterSignup($user);
    }

    //logout function
    public function logout(Request $request)
    {
        Auth::logout();

        //terminating the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        //redirecting to the login page after logout
        return redirect()->route('showlogin');
    }

    //change password function 
    public function changePassword(Request $request)
    {
        //validate the input data
        $validatedData = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        //get the currently authenticated user
        $user = Auth::user();

        //check if the current password matches
        if (!password_verify($validatedData['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided current password is incorrect.'],
            ]);
        }

        //update the user's password
        $user->password = bcrypt($validatedData['new_password']);
        $user->save();

        //redirect back with a success message
        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}
