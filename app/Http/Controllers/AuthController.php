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
        //alidate the data
        $validatedData = $request-> validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        //attempt login
        $successlogin =  Auth::attempt($validatedData);

        //checking for succesful login
        if($successlogin){

            //regenerate sessioin cookies
            $request->session()->regenerate();

            //redirect to a specific page after successful login
            return redirect()->route('student.homepage');
        }


        //if login fails, redirect back with an error message
        throw ValidationException::withMessages([
            'credentials' => ['The provided credentials are incorrect.'],
        ]);
        
    }

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

        //redirect to a specific page after successful signup

        //checking user role and redirecting accordingly
        if($user->role ==='admin'){
            return redirect()->route('admin.dashboard');
        } elseif($user->role ==='teacher'){
            return redirect()->route('teacher.dashboard');
        } else {
            return redirect()->route('studentregistration');
        }

        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        //terminating the session
        $request ->session() ->invalidate();
        $request ->session() ->regenerateToken();

        //redirecting to the login page after logout
        return redirect()->route('showlogin');
    }


}
