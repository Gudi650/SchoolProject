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
        $tabledid = $tableid;
        

        if (session()->has('class_id') && $teacher) {
            $school_id = $teacher->school_id;
            $students = Student::where('class_id', session('class_id'))
                ->where('school_id', $school_id)
                ->get();
        }
        

        // ensure studentresults is always defined for the view
        $studentresults = collect();

        //if  results was uploaded successfully
        if(session()->get('school_id') && session()->get('exam_date'))
        {
            //fetch data from ExamResults table in db 
            $school_id = session()->get('school_id');
            $exam_date = session()->get('exam_date');

            $studentresults = ExamResults::where('school_id', $school_id)
                        ->where('exam_date', $exam_date)
                        ->where('class_id', session('class_id'))
                        ->where('subject_id', session('subject_id'))
                        ->get();            
                        
            //get the lowest score
            $lowestScore = $this->getLowestScore();

            //get the highest score
            $highestScore = $this->getHighestScore();

            //get the average score
            $averagescore = $this -> getAverageScore();
        }
    
        return view('TeacherPanel.postresults', [
            'allassigned' => $assigned,
            'students' => $students,
            'tableid' => $tableid,
            'studentresults' => $studentresults,
            'tabledid' => $tabledid,
            'lowestScore' => $lowestScore ?? null,
            'highestScore' => $highestScore ?? null,
            'averagescore' => $averagescore ?? null,
        ]);
    }


    //function to handle the post exam results form submission
    public function postExamController(Request $request)
    {

        $validatedData = $request->validate([
            'class_id' => 'required|exists:class-availables,id',
            'TermName' => 'required|string',
            'subject_id' => 'required|exists:availablesubjects,id',
            'exam_date' => 'required|date',
            //'results_file' => 'required|file|mimes:csv,txt',
        ]);

        //save the input data in session for it to be used later on in filling the results of each student
        session()->put('class_id', $validatedData['class_id']);
        session()->put('TermName', $validatedData['TermName']);
        session()->put('subject_id', $validatedData['subject_id']);
        session()->put('exam_date', $validatedData['exam_date']);
        
        //try and obtain the school_id using the teacher
        //get the active teacher of the teacher
        $teacher = session()->get('activeTeacher');

        //get the school_id
        $school_id = $teacher->school_id;


        //check if there is an exam_date already existing for the same class and subject in the same school as the teacher
        $existingResults = ExamResults::where('class_id', $validatedData['class_id'])
            ->where('subject_id', $validatedData['subject_id'])
            ->where('exam_date', $validatedData['exam_date'])
            ->where('school_id', $school_id)
            ->first();

        //if there are existing results, redirect back with error message
        if ($existingResults) {
            return redirect()->route('teacher.postresults')->with('error', 'Results for this class, subject, and exam date already exist.');
        }


        //get student who are in class with class_id given and in the same school as the teacher

        $students = Student::where('class_id', session()->get('class_id'))->where('school_id', $school_id)->get();


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
            'exam_date' => 'required|date',
        ]);

        //teacher_id is a single scalar (applies to all rows)
        $teacherId = $validatedData['teacher_id'];

        //TermName is a single scalar (applies to all rows)
        $termName = $validatedData['TermName'];

        //exam_date is a single scalar (applies to all rows)
        $examDate = $validatedData['exam_date'];

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
                'exam_date' => $examDate,
            ]);
        }


        //return 
        return redirect()->route('teacher.postresults')->with('success', 'Results saved');

    }

    //set function to get the lowest score
    private function getLowestScore()
    {
        return ExamResults::where('school_id', session()->get('school_id'))
            ->where('exam_date', session()->get('exam_date'))
            ->where('class_id', session()->get('class_id'))
            ->where('subject_id', session()->get('subject_id'))
            ->min('score');
    }

    //function to get the highest score
    private function getHighestScore()
    {
        return ExamResults::where('school_id', session()->get('school_id'))
            ->where('exam_date', session()->get('exam_date'))
            ->where('class_id', session()->get('class_id'))
            ->where('subject_id', session()->get('subject_id'))
            ->max('score');
    }

    //function for averagescore
    private function getAverageScore()
    {

        return ExamResults::where('school_id', session()->get('school_id'))
            ->where('exam_date', session()->get('exam_date'))
            ->where('class_id', session()->get('class_id'))
            ->where('subject_id', session()->get('subject_id'))
            ->avg('score');

    }

    //function to handle the modal updates
    public function updateExamResult(Request $request)
    {
        //validate the incoming request data
        $validatedData = $request->validate([
            'score' => 'required|numeric|min:0|max:100',
            'remarks' => 'nullable|string|max:255',
            'result_id' => 'required|exists:exam_results,student_id',
        ]);

        //update the exam result record
        ExamResults::where('student_id', $validatedData['result_id'])
            ->where('school_id', session()->get('school_id'))
            ->where('exam_date', session()->get('exam_date'))
            ->where('class_id', session()->get('class_id'))
            ->where('subject_id', session()->get('subject_id'))
            ->update([
                'score' => $validatedData['score'],
                'remarks' => $validatedData['remarks'] ?? null,
            ]);
        

        

        //redirect back with success message
        return redirect()->route('teacher.postresults')->with('success', 'Exam result updated successfully.');
    }


}
