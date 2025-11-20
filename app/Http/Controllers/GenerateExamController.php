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
    public function generateExamPage()
    {
        $user = auth()->id();
        $teacher = Teacher::where('user_id', $user)->first();

        $dropdownData = $this->getExamDropdownData($teacher);

        // If redirected after a search, re-run the query using saved filters
        $subjects = collect();
        $examResults = collect();
        $students = collect();
        $resultSummaries = [];

        if ($filters = session('gen_filters')) {
            $school_id = $teacher->school_id;
            $examResults = ExamResults::where('school_id', $school_id)
                ->where('class_id', $filters['class_id'])
                ->whereDate('exam_date', Carbon::parse($filters['exam_date'])->toDateString())
                // ->where('TermName', $filters['exam_name']) // enable if used
                ->get();

            if ($examResults->isNotEmpty()) {
                $subjectIds = $examResults->pluck('subject_id')->unique()->values()->all();
                $subjects = availablesubject::whereIn('id', $subjectIds)->get();
                $studentIds = $examResults->pluck('student_id')->unique()->values()->all();
                $students = Student::whereIn('id', $studentIds)->get();

                // build summaries (totals/averages)
                foreach ($students as $student) {
                    $rows = $examResults->where('student_id', $student->id);
                    $resultSummaries[$student->id] = [
                        'average_score' => $rows->avg('score'),
                        'total_score' => $rows->sum('score'),
                    ];
                }
            }

            // optionally forget session filters so refresh doesn't keep them
            // session()->forget('gen_filters');
        }

        return view('TeacherPanel.generateresults', array_merge($dropdownData, [
            'subjects'     => $subjects,
            'examResults'  => $examResults,
            'students'     => $students,
            'resultSummaries' => $resultSummaries,
        ]));
    }

    public function searchExamResults(Request $request)
    {
        // Normalize form input keys if your form uses hyphens
        $request->merge([
            'exam_date' => $request->input('exam-date'),
            'exam_name' => $request->input('exam-name'),
        ]);

        $validated = $request->validate([
            'class_id'  => 'required|integer',
            'exam_date' => 'required|date',
            'exam_name' => 'required|string',
        ]);

        // Save only the small filter set in session and redirect to the GET page
        session(['gen_filters' => $validated]);
        return redirect()->route('teacher.generateresults');

        // (If you prefer to render immediate results without redirect,
        // keep the existing logic and return the view here instead.)
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