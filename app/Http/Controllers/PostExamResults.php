<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class PostExamResults extends Controller
{
    //function to show the post-exam page
    public function showPostExamPage()
    {
        // obtain the user id
        $userId = auth()->id();

        // obtain the teacher using the user id
        $teacher = Teacher::where('user_id', $userId)->first();

        //store the teacher data in session
        session()->put('activeTeacher', $teacher);

        // get the assigned teacher subjects (empty collection if no teacher)
        $assigned = $teacher ? $teacher->assignedSubjects : collect();

        //store $assigned in a session
        session()->put('assigned', $assigned);

        // pass the data to the view
        return view('TeacherPanel.postresults', ['allassigned' => $assigned]);
    }


    //function to handle the post exam results form submission
    public function postExamResults(Request $request)
    {

        $validatedData = $request->validate([
            'class_id' => 'required|exists:class-availables,id',
            'TermName' => 'required|string',
            'subject_id' => 'required|exists:availablesubjects,id',
            //'results_file' => 'required|file|mimes:csv,txt',
        ]);

        //save the input data in session for it to be used later on in filling the results of each student
        session()->put('class_id', $validatedData['class_id']);
        session()->put('TermName', $validatedData['TermName']);
        session()->put('subject_id', $validatedData['subject_id']);
        
        //try and obtain the school_id using the teacher
        //get the active teacher of the teacher
        $teacher = session()->get('activeTeacher');

        //get the school_id
        $school_id = $teacher->school_id;


        //get student who are in class with class_id given and in the same school as the teacher

        $students = Student::where('class_id', session()->get('class_id'))->where('school_id', $school_id)->get();


        //table id in the results table
        $tableid = 0;

        //return to the view
        return view('TeacherPanel.postresults', [
            'students' => $students,
            'allassigned' => session()->get('assigned'),
            'tableid' => $tableid,
        ]);
    }

    

}
