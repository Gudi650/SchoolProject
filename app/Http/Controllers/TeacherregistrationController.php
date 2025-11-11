<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherregistrationController extends Controller
{
    //function to show teacher registration form
    public function showTeacherRegistration(){
        //return view
        return view('teacherregistration');
    }

    //function to handle teacher registration form submission
    public function register(Request $request){

        //validate the form data
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers',
            'phone' => 'required|string|max:15|unique:teachers',
            'gender' => 'required|string|max:10',
            'subject_specialization' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
        ]);

        //get the current user
        $user = Auth::user();

        //get the user_id to be filled in the table 
        $userId = $user->id;

        //getting the school id
        // Replace with actual logic to get the school ID
        $schoolId = '1';


        //get the teacher record
        $teacher = Teacher::where('user_id', $userId)->first();

        if ($teacher) {

        //create a new teacher record
        Teacher::updateOrCreate(
            ['user_id' => $userId], // Assuming there's a user_id foreign key in the teachers table
            [
                'school_id' => $schoolId,
                'fname' => $validatedData['fname'],
                'mname' => $validatedData['mname'],
                'lname' => $validatedData['lname'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'gender' => $validatedData['gender'],
                'subject_specialization' => $validatedData['subject_specialization'],
                'qualification' => $validatedData['qualification'],
            ]
        );  

        }

        //redirect to the teacher panel dashboard with success message

        return redirect()->route('teacher.dashboard')->with('success', 'Teacher registration completed successfully.');


    }
}
