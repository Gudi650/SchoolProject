<?php

namespace App\Http\Controllers;

use App\Models\availablesubject;
use App\Models\ClassAvailable;
use App\Models\Teacher;
use Illuminate\Http\Request;

use App\Services\GenerateTimetableService;

class GeneratedTimetableController extends Controller
{

    protected $generateTimetableService;

    public function __construct(GenerateTimetableService $generateTimetableService)
    {
        $this->generateTimetableService = $generateTimetableService;
    }


    //function to view the generated timetable
    public function viewGeneratedTimetable()
    {

        //get the centralised data
        $data = $this->centralised_data();
        $subjects = $data['subjects'];

        return view('TeacherPanel.generatetimetable', [
            'subjects' => $subjects,
        ]);
    }


    //function to generate the timetable
    public function generateTimetable(Request $request)
    {
        //validate the input data
        $validatedData = $request->validate([

            'PeriodPerDay' =>'required|integer',
            'class_times' => 'required|string',
            'priority_subjects' => 'sometimes|array',
            'break_times' => 'sometimes|string',

        ]);

        $data = $this->centralised_data();

        //call the service to generate the timetable
        $timetable = $this->generateTimetableService->generateTimetable($validatedData , $data); 


        //dump the data
        dd($timetable);
        
    }


    //retrive the centralised data to be re-used in multiple areas
    protected function centralised_data()
    {
        //retrieve the teacher logged-in
        //get the id of the teacher
        $teacherId = auth()->id();

        //get the teacher logged in
        $teacher = Teacher::where('user_id', $teacherId)->first();

        //get the school_id
        $schoolId = $teacher->school_id;

        //get the classes in the school
        $classes = ClassAvailable::where('school_id', $schoolId)->get();

        //get the subjects in the school
        $subjects = availablesubject::where('school_id', $schoolId)->get();

        //return the data
        
        return [
            'teacherId' => $teacherId,
            'schoolId' => $schoolId,
            'classes' => $classes,
            'subjects' => $subjects,
        ];


    }


}
