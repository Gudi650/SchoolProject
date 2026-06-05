<?php

namespace App\Http\Controllers;

use App\Models\availablesubject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherregistrationController extends Controller
{
    //function to show teacher registration form
    public function showTeacherRegistration(){

        //get the personal infomation of the user to prefill the form
        $personalInfo = $this->getPersonalInfo();

        //now fetch the available subjects in the school of the user and pass it to the view to show in the subject specialization dropdown
        $subjects = $this->getSubjectsForSchool();

        //get the role of the user to show the appropriate form
        $role = $this->checkRoleAndShowForm();

        //return view
        return view('teacherregistration', [
            'personalInfo' => $personalInfo,
            'subjects' => $subjects,
            'role' => $role,
        ]);
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
            'subject_specialization' => 'nullable|string|max:255',
            'qualification' => 'required|string|max:255',
        ]);

        //get the current user
        $user = Auth::user();

        //get the user_id to be filled in the table 
        $userId = $user->id;

        //getting the school id
        //do this using session generated when the user logged in and selected the school to work with
        $schoolId = session('school_id'); 


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
                'subject_specialization' => isset($validatedData['subject_specialization']) ? $validatedData['subject_specialization'] : null,
                'qualification' => $validatedData['qualification'],
            ]
        );  
        } else {
            // If no existing teacher record, create a new one
            Teacher::create([
                'user_id' => $userId,
                'school_id' => $schoolId,
                'fname' => $validatedData['fname'],
                'mname' => $validatedData['mname'],
                'lname' => $validatedData['lname'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'gender' => $validatedData['gender'],
                'subject_specialization' => isset($validatedData['subject_specialization']) ? $validatedData['subject_specialization'] : null,
                'qualification' => $validatedData['qualification'],
            ]
        );  
        }

        //redirect to the teacher panel dashboard with success message

        //again check the role to redirect to the appropriate dashboard
        if($user->roles === 'teacher'){

        

        return redirect()->route('teacher.dashboard')->with('success', 'Teacher registration completed successfully.');

        }else if($user->roles === 'librarian'){

            return redirect()->route('library.dashboard')->with('success', 'Librarian registration completed successfully.');

        }


    }

    //get personal information of the user from the user table and prefill the form
    protected function getPersonalInfo(){
        
        //fetch the authenticated user logged in
        $user = Auth::user();

        //get the personal information of the user
        $personalInfo = [
            'fname' => $user->fname,
            'mname' => $user->mname,
            'lname' => $user->lname,
            'email' => $user->email,
            'phone' => $user->phone,
        ];

        return $personalInfo;

        //now we pass this to the view and prefill the form fields with this data
    }

    //now get the subject available in the school of the user and pass it to teh view to show in the subject specialization dropdown
    protected function getSubjectsForSchool(){


        //get the school id of the user
        $schoolId = session('school_id'); 

        //fetch the subjects available in the school from the subjects table
        $subjects = availablesubject::where('school_id', $schoolId)->get();

        return $subjects;
    }

    //check to see if the role is teacher or librarian 
    //if the role is teacher, show the teacher registration form
    //if the role is librarian, show the same registration form but toogle the words and hide somethings
    protected function checkRoleAndShowForm(){
        $user = Auth::user();

        if($user->roles === 'teacher'){
            //variable to hold the role
            $role = 'teacher';
            return $role;
        }

        if($user->roles === 'librarian'){
            $role = 'librarian';
            return $role;
        }

    }

}
