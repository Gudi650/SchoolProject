<?php

namespace App\Http\Controllers;

use App\Models\AssignedRole;
use App\Services\TeacherContextService;
use Illuminate\Http\Request;

class AssignClasses extends Controller
{
    public function __construct(private TeacherContextService $teacherContext)
    {
    }

    public function showAssignClasses()
    {
        $teacher = $this->teacherContext->loggedInTeacher();

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Teacher profile not found.');
        }

        $schoolId = $teacher->school_id;
        $teachers = $this->teacherContext->schoolTeachers($schoolId);

        return view('TeacherPanel.assignclasses', [
            'classes' => $this->teacherContext->schoolClasses($schoolId),
            'teachers' => $teachers,
            'assignedTeachers' => AssignedRole::whereIn('teacher_id', $teachers->pluck('id'))
                ->whereNotNull('class-available_id')
                ->get(),
        ]);
    }

    public function assignClasses(Request $request)
    {
        $validatedData = $request->validate([
            'class-available_id' => 'required|exists:class_availables,id',
            'teacher_id' => 'required|exists:assigned_roles,teacher_id',
        ]);

        AssignedRole::where('teacher_id', $validatedData['teacher_id'])
            ->update(['class-available_id' => $validatedData['class-available_id']]);

        return redirect()->route('teacher.assignclasses')->with('success', 'Class assigned successfully.');
    }
}
