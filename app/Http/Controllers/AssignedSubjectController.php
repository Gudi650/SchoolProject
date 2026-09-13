<?php

namespace App\Http\Controllers;

use App\Models\AssignedSubject;
use App\Services\TeacherContextService;
use Illuminate\Http\Request;

class AssignedSubjectController extends Controller
{
    public function __construct(private TeacherContextService $teacherContext)
    {
    }

    public function showAssignedSubjects()
    {
        $teacher = $this->teacherContext->loggedInTeacher();
        abort_if(!$teacher, 403);

        $schoolId = $teacher->school_id;

        return view('TeacherPanel.assignsubjects', [
            'teachers' => $this->teacherContext->schoolTeachers($schoolId),
            'subjects' => $this->teacherContext->subjects($teacher),
            'classes' => $this->teacherContext->schoolClasses($schoolId),
            'assignedTeachers' => AssignedSubject::where('school_id', $schoolId)
                ->with(['teacher', 'availablesubject', 'classAvailable'])
                ->get(),
        ]);
    }

    public function assignSubjectToTeacher(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:class_availables,id',
            'availablesubject_id' => 'required|exists:availablesubjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'school_id' => 'required|exists:schools,id',
        ]);

        AssignedSubject::create($validated);

        return redirect()->back()->with('success', 'Subject assigned to teacher successfully.');
    }
}
