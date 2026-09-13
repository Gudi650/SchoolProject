<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Services\StudentContextService;
use App\Services\TeacherContextService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    public function __construct(
        private TeacherContextService $teacherContext,
        private StudentContextService $studentContext,
    ) 
    {
        
    }

    public function showTeacherAssignments()
    {
        $teacher = $this->teacherContext->requireTeacher();

        return view('TeacherPanel.assignments.assignments', [
            'teacher' => $teacher,
            'classes' => $this->teacherContext->schoolClasses($teacher->school_id),
            'subjects' => $this->teacherContext->assignedSubjectsFor($teacher),
            'assignments' => Assignment::with(['classAvailable', 'subject'])
                ->where('school_id', $teacher->school_id)
                ->where('teacher_id', $teacher->id)
                ->latest()
                ->get(),
        ]);
    }

    public function storeTeacherAssignment(Request $request)
    {
        $teacher = $this->teacherContext->requireTeacher();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'due_date' => ['required', 'date'],
            'class_id' => ['required', 'exists:class_availables,id'],
            'subject_id' => ['nullable', 'exists:availablesubjects,id'],
            'attachment' => ['nullable', 'file', 'max:10240', 'mimes:pdf,doc,docx,zip,png,jpg,jpeg'],
        ]);

        $attachmentPath = $request->hasFile('attachment')
            ? $request->file('attachment')->store('assignments', 'public')
            : null;

        Assignment::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'],
            'school_id' => $teacher->school_id,
            'teacher_id' => $teacher->id,
            'class-available_id' => $validated['class_id'],
            'subject_id' => $validated['subject_id'] ?? null,
            'attachment' => $attachmentPath,
        ]);

        return redirect()->route('teacher.assignments')->with('success', 'Assignment published successfully.');
    }

    public function showStudentAssignments()
    {
        $student = $this->studentContext->loggedInStudent();
        $assignments = collect();
        $submissions = collect();
        $pendingCount = 0;

        if ($student) {
            $assignments = Assignment::with(['teacher', 'classAvailable', 'subject'])
                ->where('school_id', $student->school_id)
                ->where('class-available_id', $student->class_id)
                ->latest()
                ->get();

            $submissions = DB::table('assignment_submissions')
                ->where('student_id', $student->id)
                ->get()
                ->keyBy('assignment_id');

            $pendingCount = $assignments->reject(fn ($a) => $submissions->has($a->id))->count();
        }

        return view('StudentPanel.assignment', compact('student', 'assignments', 'submissions', 'pendingCount'));
    }

    public function storeStudentAssignmentSubmission(Request $request)
    {
        $student = $this->studentContext->requireStudent();

        $validated = $request->validate([
            'assignment_id' => ['required', 'exists:assignments,id'],
            'attachment' => ['required', 'file', 'max:10240', 'mimes:pdf,doc,docx,zip,png,jpg,jpeg'],
            'remarks' => ['nullable', 'string', 'max:1000'],
        ]);

        $assignment = DB::table('assignments')
            ->where('id', $validated['assignment_id'])
            ->where('school_id', $student->school_id)
            ->where('class-available_id', $student->class_id)
            ->first();

        abort_if(!$assignment, 404);

        DB::table('assignment_submissions')->updateOrInsert(
            ['assignment_id' => $assignment->id, 'student_id' => $student->id],
            [
                'attachment' => $request->file('attachment')->store('assignment-submissions', 'public'),
                'remarks' => $validated['remarks'] ?? null,
                'submitted_at' => now(),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return redirect()->route('student.assignments')->with('success', 'Your assignment was submitted successfully.');
    }

    public function showDeliveredAssignments(Request $request)
    {
        $teacher = $this->teacherContext->requireTeacher();

        $assignments = Assignment::query()
            ->where('teacher_id', $teacher->id)
            ->orderByDesc('created_at')
            ->get();

        $selectedAssignmentId = $request->integer('assignment_id') ?: $assignments->first()?->id;

        $submissions = AssignmentSubmission::with(['assignment', 'student'])
            ->whereHas('assignment', fn ($q) => $q->where('teacher_id', $teacher->id))
            ->when($selectedAssignmentId, fn ($q, $id) => $q->where('assignment_id', $id))
            ->orderByDesc('submitted_at')
            ->get();

        return view('TeacherPanel.assignments.deliveredAssignments', compact(
            'teacher', 'assignments', 'selectedAssignmentId', 'submissions'
        ));
    }
}
