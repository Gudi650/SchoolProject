<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class studentEnrollment extends Controller
{
    
    //the view function
    public function viewStudentEnrollment()
    {

        //get the schools from the db 
        $schools = School::all();

        return view('studentEnrollment', ['schools' => $schools]);
    }

    //function to handle form submission 
    public function submitEnrollmentForm(Request $request, int $step)
    {
        switch($step){

            case 1:
                //handle step 1 submission
                //validate the form data
                $validatedData = $request->validate([
                    'fname' => 'required|string|max:255',
                    'mname' => 'required|string|max:255',
                    'lname' => 'required|string|max:255',
                    'dob' => 'required|date',
                    'gender' => 'required|string|in:male,female,other',
                    'school_id' => 'required|exists:schools,id',
                ]);

                //show the output for testing purposes
                dd($validatedData);
                



        }

        

    }


}
