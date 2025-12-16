<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class studentEnrollment extends Controller
{
    
    //the view function
    public function viewStudentEnrollment()
    {
        return view('studentEnrollment');
    }

    //function to handle form submission 
    public function submitEnrollmentForm(Request $request)
    {

        //validate the form data
        

    }


}
