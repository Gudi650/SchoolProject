<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Services\TeacherContextService;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct(private TeacherContextService $teacherContext)
    {
    }

    public function registerStudentAttendance()
    {
        $data = $this->teacherContext->attendanceContext();
        $teacher = $data['teacher'];

        if (!$this->teacherContext->isClassTeacher($teacher) || !$data['classId']) {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }

        return view('TeacherPanel.registerattendance', [
            'students' => $data['students'],
            'className' => $data['className'],
            'Tablenumber' => 1,
            'schoolId' => $data['schoolId'],
            'classId' => $data['classId'],
        ]);
    }

    public function markAllPresent(Request $request)
    {
        $data = $this->teacherContext->attendanceContext();
        $validatedData = $request->validate(['date' => 'required|date']);
        $date = $validatedData['date'];

        $existingAttendance = Attendance::where('class-available_id', $data['classId'])
            ->where('date', $date)
            ->first();

        if ($existingAttendance) {
            return redirect()->back()->with('error', 'Attendance for this date has already been recorded, Please cross-check the date you inserted.');
        }

        foreach ($data['students'] as $student) {
            Attendance::create([
                'student_id' => $student->id,
                'class-available_id' => $data['classId'],
                'school_id' => $data['schoolId'],
                'date' => $date,
                'status' => '1',
            ]);
        }

        return redirect()->back()->with('success', 'All students have been marked as present for the date '.$date.'.');
    }

    public function markPresentExceptAbsent(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'absent_students' => 'array',
            'absent_students.*' => 'integer|exists:students,id',
        ]);

        $data = $this->teacherContext->attendanceContext();
        $date = $validatedData['date'];
        $absentStudents = $validatedData['absent_students'] ?? [];
        $presentStudents = $data['students']->whereNotIn('id', $absentStudents);

        foreach ($presentStudents as $student) {
            Attendance::create([
                'student_id' => $student->id,
                'class-available_id' => $data['classId'],
                'school_id' => $data['schoolId'],
                'date' => $date,
                'status' => '1',
            ]);
        }

        foreach ($absentStudents as $studentId) {
            Attendance::create([
                'student_id' => $studentId,
                'class-available_id' => $data['classId'],
                'school_id' => $data['schoolId'],
                'date' => $date,
                'status' => '0',
            ]);
        }

        return redirect()->back()->with('success', 'Attendance has been recorded. Present students have been marked for the date '.$date.'.');
    }
}
