<?php

namespace App\Http\Controllers;

use App\Models\availablesubject;
use App\Models\ExamResults;
use App\Models\GeneratedResults;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GenerateExamController extends Controller
{
    /**
     * Show the exam results page with rankings.
     */
    public function generateExamPage()
    {
        $user = auth()->id();
        $teacher = Teacher::where('user_id', $user)->first();

        $dropdownData = $this->getExamDropdownData($teacher);

        $subjects = collect();
        $examResults = collect();
        $students = collect();
        $rankedSummaries = [];

        if ($filters = session('gen_filters')) {
            $school_id = $teacher->school_id;

            $examResults = ExamResults::where('school_id', $school_id)
                ->where('class_id', $filters['class_id'])
                ->whereDate('exam_date', Carbon::parse($filters['exam_date'])->toDateString())
                // ->where('TermName', $filters['exam_name']) // enable if needed
                ->get();

            if ($examResults->isNotEmpty()) {
                $subjectIds = $examResults->pluck('subject_id')->unique()->values()->all();
                $subjects = availablesubject::whereIn('id', $subjectIds)->get();

                $studentIds = $examResults->pluck('student_id')->unique()->values()->all();
                $students = Student::whereIn('id', $studentIds)->get();

                // Build summaries (totals/averages)
                $resultSummaries = [];
                foreach ($students as $student) {
                    $rows = $examResults->where('student_id', $student->id);
                    $resultSummaries[$student->id] = [
                        'average_score' => $rows->avg('score'),
                        'total_score'   => $rows->sum('score'),
                    ];
                }

                //Sort by average score and assign ranks
                $sortedSummaries = collect($resultSummaries)->sortByDesc('average_score');
                $rank = 1;
                foreach ($sortedSummaries as $studentId => $summary) {
                    $rankedSummaries[$studentId] = array_merge($summary, [
                        'rank' => $rank
                    ]);
                    $rank++;
                }

                //sort the students collection based on average score
                $students = collect($students)->sortByDesc
                (function($student) use ($rankedSummaries) 
                {
                    return $rankedSummaries[$student->id]['average_score'];
                })->values();

            }

            // Optionally clear filters after use
            // session()->forget('gen_filters');
        }

        return view('TeacherPanel.generateresults', array_merge($dropdownData, [
            'subjects'        => $subjects,
            'examResults'     => $examResults,
            'students'        => $students,
            'resultSummaries' => $rankedSummaries, 
        ]));
    }

    /**
     * Handle search form submission and save filters in session.
     */
    public function searchExamResults(Request $request)
    {
        $request->merge([
            'exam_date' => $request->input('exam-date'),
            'exam_name' => $request->input('exam-name'),
        ]);

        $validated = $request->validate([
            'class_id'  => 'required|integer',
            'exam_date' => 'required|date',
            //'exam_name' => 'required|string',
        ]);

        session(['gen_filters' => $validated]);
        return redirect()->route('teacher.generateresults');
    }



    /**
     * Save generated exam results summaries to the database.
     */    
    

    public function saveGeneratedResults(Request $request)
    {
        $user = auth()->id();
        $teacher = Teacher::where('user_id', $user)->first();

        $filters = session('gen_filters');
        if (!$filters) {
            return redirect()->route('teacher.generateresults')->withErrors('No filters found for saving results.');
        }

        $school_id = $teacher->school_id;

        //check if the data to be generated already exists such that the same school, same class and same exam date
        $existing = GeneratedResults::where('school_id', $school_id)
            ->where('class_id', $filters['class_id'])
            ->whereDate('exam_date', Carbon::parse($filters['exam_date'])->toDateString())
            ->first();

        if ($existing) {
            return redirect()->route('teacher.generateresults')->withErrors("Generated results already exist for class {$filters['class_id']} and exam date {$filters['exam_date']}.");
        }   



        $examResults = ExamResults::where('school_id', $school_id)
            ->where('class_id', $filters['class_id'])
            ->whereDate('exam_date', Carbon::parse($filters['exam_date'])->toDateString())
            // ->where('TermName', $filters['exam_name']) // enable if needed
            ->get();

        if ($examResults->isEmpty()) {
            return redirect()->route('teacher.generateresults')->withErrors('No exam results found to generate summaries.');
        }

        $studentIds = $examResults->pluck('student_id')->unique()->values()->all();

        // compute totals/averages per student and assign dense ranks
        $grouped = $examResults->groupBy('student_id')->map(function ($rows, $studentId) {
            return [
                'student_id' => (int) $studentId,
                'total'      => (int) $rows->sum('score'),
                'average'    => round($rows->avg('score'), 2),
                'subjects'   => $rows->count(),
            ];
        })->values();

        $sorted = $grouped->sortByDesc('average')->values();
        $rank = 0;
        $prevAvg = null;
        foreach ($sorted as $item) {
            if ($prevAvg !== $item['average']) {
                $rank++;
                $prevAvg = $item['average'];
            }

            GeneratedResults::create([
                'school_id'     => $school_id,
                'class_id'      => $filters['class_id'],
                'exam_date'     => Carbon::parse($filters['exam_date'])->toDateString(),
                'student_id'    => $item['student_id'],
                'total_score'   => $item['total'],
                'average_score' => $item['average'],
                'rank'          => $rank,
            ]);
        }



        return redirect()->route('teacher.generateresults')->with('success', 'Generated results saved successfully.');
    }



    /**
     * Prepare dropdown data for exam filters.
     */
    private function getExamDropdownData(Teacher $teacher)
    {
        $school_id = $teacher->school_id;
        $classes = $teacher->schools->classAvailables;
        $exams = ExamResults::where('school_id', $school_id)->get();

        return [
            'classes'   => $classes,
            'examDates' => $exams->pluck('exam_date')->unique(),
            'examNames' => $exams->pluck('TermName')->unique(),
        ];
    }
}