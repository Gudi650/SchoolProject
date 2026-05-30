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
        $classes = $data['classes'];
        $subjects = $data['subjects'];

        return view('TeacherPanel.generatetimetable', [
            'classes' => $classes,
            'subjects' => $subjects,
            'timetables' => [],
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
            'days_exceptions' => 'sometimes|array',
            'periods_days_exceptions' => 'sometimes|array',

        ]);

        $data = $this->centralised_data();

        //call the service to generate the timetable
        $timetable = $this->generateTimetableService->generateTimetable($validatedData , $data);
        $timetables = $this->formatTimetablesForView($timetable, $data['classes']);

        /*dump 
        dd($timetable); */


        return view('TeacherPanel.generatetimetable', [
            'classes' => $data['classes'],
            'subjects' => $data['subjects'],
            'timetables' => $timetables,
        ]);
    }


    protected function formatTimetablesForView(array $timetable, $classes): array
    {
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $classNamesById = $classes->pluck('class_name', 'id')->toArray();
        $formatted = [];

        foreach ($timetable as $classId => $days) {
            $className = $classNamesById[$classId] ?? 'Class ' . $classId;
            $maxPeriods = 0;

            foreach ($daysOfWeek as $day) {
                $maxPeriods = max($maxPeriods, count($days[$day] ?? []));
            }

            $rows = [];
            for ($periodIndex = 0; $periodIndex < $maxPeriods; $periodIndex++) {
                $row = ['time' => 'Period ' . ($periodIndex + 1)];

                foreach ($daysOfWeek as $day) {
                    $entry = $days[$day][$periodIndex] ?? null;
                    $row[strtolower($day)] = [
                        'subject' => $entry['subject_name'] ?? '-',
                    ];
                }

                $rows[] = $row;
            }

            $formatted[$className] = $rows;
        }

        return $formatted;
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
