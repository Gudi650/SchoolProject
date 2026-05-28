<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    public function showTeacherAssignments()
    {
        $teacher = DB::table('teachers')->where('user_id', Auth::id())->first();

        abort_if(!$teacher, 403);

        $classes = DB::table('class_availables')
            ->where('school_id', $teacher->school_id)
            ->orderBy('name')
            ->get();

        $subjects = DB::table('availablesubjects')
            ->where('school_id', $teacher->school_id)
            ->orderBy('subject_name')
            ->get();

        $assignments = Assignment::with(['classAvailable', 'subject'])
            ->where('school_id', $teacher->school_id)
            ->where('teacher_id', $teacher->id)
            ->latest()
            ->get();

        return view('TeacherPanel.assignments.assignments', [
            'teacher' => $teacher,
            'classes' => $classes,
            'subjects' => $subjects,
            'assignments' => $assignments,
        ]);
    }

    public function storeTeacherAssignment(Request $request)
    {
        $teacher = DB::table('teachers')->where('user_id', Auth::id())->first();

        abort_if(!$teacher, 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'due_date' => ['required', 'date'],
            'class_id' => ['required', 'exists:class_availables,id'],
            'subject_id' => ['nullable', 'exists:availablesubjects,id'],
            'attachment' => ['nullable', 'file', 'max:10240', 'mimes:pdf,doc,docx,zip,png,jpg,jpeg'],
        ]);

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('assignments', 'public');
        }

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

        return redirect()->route('teacher.assignments.assignments')->with('success', 'Assignment published successfully.');
    }

    public function showStudentAssignments()
    {
        $student = DB::table('students')->where('user_id', Auth::id())->first();
        $assignments = collect();

        if ($student) {
            $assignments = Assignment::with(['teacher', 'classAvailable', 'subject'])
                ->where('school_id', $student->school_id)
                ->where('class-available_id', $student->class_id)
                ->latest()
                ->get();
        }

        return view('StudentPanel.assignments-live', [
            'student' => $student,
            'assignments' => $assignments,
        ]);
    }

    public function showDeliveredAssignments(Request $request)
    {
        $teacher = DB::table('teachers')->where('user_id', Auth::id())->first();

        abort_if(!$teacher, 403);

        $assignments = Assignment::query()
            ->where('teacher_id', $teacher->id)
            ->orderByDesc('created_at')
            ->get();

        $selectedAssignmentId = $request->integer('assignment_id') ?: $assignments->first()?->id;

        $submissions = AssignmentSubmission::with(['assignment', 'student'])
            ->whereHas('assignment', function ($query) use ($teacher) {
                $query->where('teacher_id', $teacher->id);
            })
            ->when($selectedAssignmentId, function ($query, $assignmentId) {
                $query->where('assignment_id', $assignmentId);
            })
            ->orderByDesc('submitted_at')
            ->get();

        return view('TeacherPanel.assignments.deliveredAssignments', [
            'teacher' => $teacher,
            'assignments' => $assignments,
            'selectedAssignmentId' => $selectedAssignmentId,
            'submissions' => $submissions,
        ]);
    }
}
