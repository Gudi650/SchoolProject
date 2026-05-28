<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\ClassAvailable;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function showTeacherAssignments()
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();

        abort_if(!$teacher, 403);

        $classes = ClassAvailable::where('school_id', $teacher->school_id)
            ->orderBy('name')
            ->get();

        $assignments = Assignment::with(['classAvailable'])
            ->where('school_id', $teacher->school_id)
            ->where('teacher_id', $teacher->id)
            ->latest()
            ->get();

        return view('TeacherPanel.assignments', [
            'teacher' => $teacher,
            'classes' => $classes,
            'assignments' => $assignments,
        ]);
    }

    public function storeTeacherAssignment(Request $request)
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();

        abort_if(!$teacher, 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'due_date' => ['required', 'date'],
            'class_id' => ['required', 'exists:class_availables,id'],
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
            'attachment' => $attachmentPath,
        ]);

        return redirect()->route('teacher.assignments')->with('success', 'Assignment published successfully.');
    }

    public function showStudentAssignments()
    {
        $student = auth()->user()->students;
        $assignments = collect();

        if ($student) {
            $assignments = Assignment::with(['teacher', 'classAvailable'])
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
}
