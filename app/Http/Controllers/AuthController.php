<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //showing the login page
    public function showLogin()
    {
        return view('login');
    }

    //showing the signup page
    public function showSignUp()
    {
        return view('signup');
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

            //get the role of the logged in user
            $user = Auth::user();

            if($user->roles === 'teacher'){
                //redirect to a specific page after successful login
                return redirect()->route('teacher.dashboard');
            }

            if($user->roles === 'student'){
                //redirect to a specific page after successful login
                return redirect()->route('student.homepage');
            }

            // fallback redirect
            return redirect()->route('student.homepage');
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
            'role' => 'required|string|in:student,teacher,admin',
            'email' => 'required|email|unique:users,email',
            'email_confirmation' => 'required|same:email',
            'password' => 'required|string|min:8|confirmed',
        ]);

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

        //checking user role and redirecting accordingly
        if($user->roles === 'teacher'){
            return redirect()->route('showteacherregistration');
        }
        if($user->roles === 'student'){
            return redirect()->route('studentregistration');
        }

        // default fallback
        return redirect()->route('studentregistration');
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
