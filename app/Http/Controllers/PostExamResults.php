<?php

namespace App\Http\Controllers;

use App\Models\ExamResults;
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

        // If a class was chosen previously, load students for the GET view (PRG)
        $students = null;
        $tableid = 0;
        if (session()->has('class_id') && $teacher) {
            $school_id = $teacher->school_id;
            $students = Student::where('class_id', session('class_id'))
                ->where('school_id', $school_id)
                ->get();
        }

    

        return view('TeacherPanel.postresults', [
            'allassigned' => $assigned,
            'students' => $students,
            'tableid' => $tableid,
        ]);
    }


    //function to handle the post exam results form submission
    public function postExamController(Request $request)
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


        // Do not return view from POST — redirect to GET route (PRG)
        return redirect()->route('teacher.postresults');


    }

    //function to take the score inputs and save them to the database

    public function postExamResults(Request $request)
    {
        //code to save the exam results to the database will go here
        //validate the incoming request data
        $validatedData = $request->validate([
            'student_id.*' => 'required|exists:students,id',
            'score.*' => 'required|numeric|min:0|max:100',
            'remarks.*' => 'nullable|string|max:255',
            'TermName' => 'required|string',
            'subject_id.*' => 'required|exists:availablesubjects,id',
            'class_id.*' => 'required|exists:class-availables,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        //teacher_id is a single scalar (applies to all rows)
        $teacherId = $validatedData['teacher_id'];

        //TermName is a single scalar (applies to all rows)
        $termName = $validatedData['TermName'];

        //get the school_id using the teacher id
        $teacher = Teacher::find($teacherId);
        $schoolId = $teacher->school_id;

        //store schoolId in session
        session()->put('school_id', $schoolId);

        //loop through each student's result and save to database
        foreach ($validatedData['student_id'] as $index => $studentId) {
            //create a new exam result record
            ExamResults::create([
                'student_id' => $studentId,
                'class_id' => $validatedData['class_id'][$index],
                'subject_id' => $validatedData['subject_id'][$index],
                'teacher_id' => $teacherId,
                'TermName' => $termName,
                'score' => $validatedData['score'][$index],
                'remarks' => $validatedData['remarks'][$index] ?? null,
                // Assuming school_id can be obtained from the teacher
                'school_id' => $schoolId,
            ]);
        }

        //return 
        return redirect()->route('teacher.postresults')->with('success', 'Results saved');

    }

    

}
