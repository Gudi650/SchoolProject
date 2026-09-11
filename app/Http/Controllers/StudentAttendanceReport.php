<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Services\TeacherContextService;

class StudentAttendanceReport extends Controller
{
    public function __construct(private TeacherContextService $teacherContext)
    {
    }

    public function ViewStudentAttendance()
    {
        $teacher = $this->teacherContext->loggedInTeacher();
        $class = $this->teacherContext->classTeacherClass($teacher);

        if (!$this->teacherContext->isClassTeacher($teacher) || !$class['classId']) {
            return redirect()->back()->with('error', 'You do not have permission to access this page.');
        }

        $students = Attendance::where('school_id', $teacher->school_id)
            ->where('class-available_id', $class['classId'])
            ->with('student')
            ->latest('date')
            ->get();

        return view('TeacherPanel.studentattendance', [
            'students' => $students,
            'schoolId' => $teacher->school_id,
            'classId' => $class['classId'],
        ]);
    }
}
