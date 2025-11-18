<?php

namespace App\Http\Controllers;

use App\Models\ClassAvailable;
use App\Models\ParentData;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentregistrationController extends Controller
{
    //showing the parent registration page
    public function showParentRegistration()
    {
        return view('parentregistration');
    }

    //showing the student registration page
    public function showStudentRegistration()
    {

        //get the classes where the school id is equal to the session school id
        $classes = ClassAvailable::where('school_id', session('school_id'))->get();

        
        //pass the data to the view as well
        return view('studentregistration', ['classes' => $classes]);

    }

    //handling parent registration form submission
    public function ParentRegistration(Request $request)
    {

        //validating the parent data
        $validatedData = $request -> validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'nullable|email|unique:parent_data,email',
            'phone' => 'required|string',
            'rtnship' => 'required|string|in:mother,father,guardian,other',
            'street' => 'nullable|string|max:255',
            'ward' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        //get the currently authenticated user
        $user = Auth::user();

        //get the student associated with the user
        $student = Student::where('user_id', $user->id)->first();

        //check if student exists
        if($student){

            //create or update parent record in the database
            ParentData::updateOrCreate(
                ['student_id' => $student->id], // Assuming there's a student_id foreign key in the parents table

                // Merge user_id into validated data
                array_merge($validatedData, ['user_id' => $user->id]) 
                
            );

        }
        


        // Handle parent registration form submission
        return redirect()->route('student.homepage')->with('success', 'Parent registered successfully.');
    }



    //handlng student registration form submission
    public function StudentRegistration(Request $request)
    {

        //validating the data given 
        $validatedData =$request ->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'class_id' => 'required|integer|exists:class-availables,id',
            'street' => 'nullable|string|max:255',
            'ward' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]); 

        $user = Auth::user();

        //Merge the user_id into the validated data before saving
        $validatedData['user_id'] = $user->id;

        //merge school_id to the validated data from a session
        $validatedData['school_id'] = session('school_id');

        //create or update student record in the database

        Student::updateOrCreate(
            // Assuming there's a user_id foreign key in the students table
            ['user_id' => $user->id], 
            $validatedData
        );

        // Handle student registration form submission
        return redirect()->route('showparentregistration')->with('success', 'Student registered successfully.');
    }
}
