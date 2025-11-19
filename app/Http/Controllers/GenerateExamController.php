<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class GenerateExamController extends Controller
{
    //view for generating exam page
    public function generateExamPage(){

        //get the teacher logged in
        //get the user id
        $user = auth()->id();

        //teacher with the user id above
        $teacher = Teacher::where('user_id', $user)->first();

        //get the school_id of the teacher
        $school_id = $teacher->school_id;

        //get the available classes in the school
        $classes = $teacher->schools->classAvailables;


        return view('TeacherPanel.generateresults' ,[
            'classes' => $classes,
        ]);
    }
}
