<?php

namespace App\Http\Controllers;

use App\Models\availablesubject;
use App\Models\ClassAvailable;
use App\Models\GeneratedTimetable;
use App\Models\Teacher;
use Carbon\Carbon;
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

        //get assigned subjects for the school and include relations
        $assignedSubjects = \App\Models\AssignedSubject::where('school_id', $data['schoolId'])->with(['teacher', 'availablesubject'])->get();

        //call the service to generate the timetable
        $timetable = $this->generateTimetableService->generateTimetable($validatedData , array_merge($data, ['assignedSubjects' => $assignedSubjects]));
        $this->persistTimetables($timetable, $data['schoolId'], $validatedData);
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
        $classNamesById = $classes->pluck('name', 'id')->toArray();
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


    protected function persistTimetables(array $rawTimetable, int $schoolId, array $validatedData): void
    {
        GeneratedTimetable::where('school_id', $schoolId)->delete();

        $parts = explode('-', $validatedData['class_times']);
        $dayStart = Carbon::createFromFormat('H:i', trim($parts[0]));
        $totalHours = $this->generateTimetableService->calculateHours($validatedData);

        foreach ($rawTimetable as $classId => $days) {
            foreach ($days as $day => $periods) {
                $slotCount = count($periods);
                if ($slotCount <= 0) {
                    continue;
                }

                $durationMinutes = ($totalHours / $slotCount) * 60;

                foreach ($periods as $index => $slot) {
                    if (empty($slot['subject_id']) || empty($slot['teacher_id'])) {
                        continue;
                    }

                    $start = $dayStart->copy()->addMinutes((int) round($index * $durationMinutes));
                    $end = $start->copy()->addMinutes((int) round($durationMinutes));

                    GeneratedTimetable::create([
                        'class_id' => $classId,
                        'school_id' => $schoolId,
                        'subject_id' => $slot['subject_id'],
                        'teacher_id' => $slot['teacher_id'],
                        'start_time' => $start->format('H:i:s'),
                        'end_time' => $end->format('H:i:s'),
                        'day_of_week' => $day,
                    ]);
                }
            }
        }
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
