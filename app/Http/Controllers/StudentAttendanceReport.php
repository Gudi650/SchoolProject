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
        $data = $this->teacherContext->attendanceContext();

        if (!$this->teacherContext->isClassTeacher($data['teacher']) || !$data['classId']) {
            return redirect()->back()->with('error', 'You do not have permission to access this page.');
        }

        return view('TeacherPanel.studentattendance', [
            'students' => Attendance::where('school_id', $data['schoolId'])
                ->where('class-available_id', $data['classId'])
                ->with('student')
                ->latest('date')
                ->get(),
            'schoolId' => $data['schoolId'],
            'classId' => $data['classId'],
        ]);
    }
}
