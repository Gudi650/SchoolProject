<?php

namespace App\Http\Controllers;

use App\Models\availablesubject;
use App\Models\ExamResults;
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