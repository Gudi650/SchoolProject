<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ExamResults;
use App\Models\GeneratedResults;
use App\Services\ScheduleService;
use App\Services\StudentContextService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Student extends Controller
{
    public function __construct(
        private StudentContextService $studentContext,
        private ScheduleService $schedule,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get the logged-in user
        $user = Auth::user();

        if (!$user) {
            // no authenticated user - show the welcome page without student data
            return view('welcome');
        }

        $student = $this->studentContext->loggedInStudent();

        // retrieve the parents data
        $parent = $student ? $student->parent_data : null;

        // return the view with student data (may be null)
        return view('welcome', compact('student', 'parent'));
    }

    public function showTimetable()
    {
        $student = $this->studentContext->loggedInStudent();
        $className = $student?->classAvailables?->name;
        $scheduleByDay = $student ? $this->schedule->forClass($student) : collect();
        $days = $this->schedule->weekdays();

        return view('StudentPanel.timetable', compact('student', 'className', 'scheduleByDay', 'days'));
    }

    public function showExamResults()
    {
        $student = $this->studentContext->loggedInStudent();
        $terms = [];
        $currentTerm = null;
        $previousTerm = null;

        if ($student) {
            $grouped = ExamResults::with('availablesubject')
                ->where('student_id', $student->id)
                ->orderByDesc('created_at')
                ->get()
                ->groupBy('TermName')
                ->sortByDesc(fn ($rows) => $rows->max('created_at'));

            $generated = GeneratedResults::where('student_id', $student->id)
                ->latest('exam_date')
                ->first();

            $classSize = $generated
                ? GeneratedResults::where('class_id', $student->class_id)
                    ->where('exam_date', $generated->exam_date)
                    ->count()
                : null;

            $latestTerm = $grouped->keys()->first();

            foreach ($grouped as $termName => $rows) {
                $avg = round($rows->avg('score'), 1);
                $terms[$termName] = [
                    'average' => $avg,
                    'remarks' => $this->performanceLabel($avg),
                    'position' => ($generated && $termName === $latestTerm)
                        ? ($generated->rank . ($classSize ? '/' . $classSize : ''))
                        : '—',
                    'teacher_remarks' => $rows->pluck('remarks')->filter()->first() ?? 'No remarks yet.',
                    'results' => $rows->map(fn ($r) => [
                        'subject' => $r->availablesubject->name ?? $r->availablesubject->subject_name ?? 'Subject',
                        'score' => $r->score,
                        'grade' => $this->gradeLabel((int) $r->score),
                    ])->values()->all(),
                ];
            }

            $termKeys = array_keys($terms);
            $currentTerm = $termKeys[0] ?? null;
            $previousTerm = $termKeys[1] ?? null;
        }

        return view('StudentPanel.exams-results', compact('student', 'terms', 'currentTerm', 'previousTerm'));
    }

    public function showAttendanceReport()
    {
        $student = $this->studentContext->loggedInStudent();
        $records = collect();
        $stats = ['total' => 0, 'present' => 0, 'absent' => 0, 'pct' => 0];
        $monthly = collect();

        if ($student) {
            $records = Attendance::where('student_id', $student->id)->orderByDesc('date')->get();
            $total = $records->count();
            $present = $records->where('status', '1')->count();
            $absent = $records->where('status', '0')->count();

            $stats = [
                'total' => $total,
                'present' => $present,
                'absent' => $absent,
                'pct' => $total ? (int) round(($present / $total) * 100) : 0,
            ];

            $monthly = $records->groupBy(fn ($r) => \Carbon\Carbon::parse($r->date)->format('M Y'))
                ->map(fn ($rows) => $rows->count() ? (int) round($rows->where('status', '1')->count() / $rows->count() * 100) : 0)
                ->take(6);
        }

        return view('StudentPanel.attendance.attendancereport', compact('student', 'records', 'stats', 'monthly'));
    }

    private function gradeLabel(int $score): string
    {
        if ($score >= 90) return 'A+';
        if ($score >= 80) return 'A';
        if ($score >= 70) return 'B';
        if ($score >= 60) return 'C';
        return 'D';
    }

    private function performanceLabel(float $avg): string
    {
        if ($avg >= 90) return 'Excellent';
        if ($avg >= 80) return 'Very Good';
        if ($avg >= 70) return 'Good';
        if ($avg >= 60) return 'Fair';
        return 'Needs Improvement';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
