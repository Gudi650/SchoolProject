<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Student;
use App\Models\AssignedSubject;
use App\Services\AnnouncementService;
use App\Services\ScheduleService;
use App\Services\TeacherContextService;

class TeacherController extends Controller
{
    public function __construct(
        private TeacherContextService $teacherContext,
        private AnnouncementService $announcements,
        private ScheduleService $schedule,
    ) {
    }

    public function dashboard()
    {
        $teacher = $this->teacherContext->loggedInTeacher();

        if (!$teacher) {
            return view('TeacherPanel.dashboard', ['teacher' => null]);
        }

        $stats = [
            'students' => Student::where('school_id', $teacher->school_id)->count(),
            'classes' => AssignedSubject::where('teacher_id', $teacher->id)->distinct('class_id')->count('class_id'),
            'assignments' => Assignment::where('teacher_id', $teacher->id)->count(),
            'announcements' => $this->announcements->countForTeacher($teacher),
        ];

        return view('TeacherPanel.dashboard', [
            'teacher' => $teacher,
            'stats' => $stats,
            'recentAnnouncements' => $this->announcements->recentForTeacher($teacher),
            'todaySchedule' => $this->schedule->todayForTeacher($teacher),
            'assignedClasses' => $this->teacherContext->assignedClasses($teacher),
        ]);
    }

    public function showSchedule()
    {
        $teacher = $this->teacherContext->loggedInTeacher();

        if (!$teacher) {
            return view('TeacherPanel.schedule', [
                'scheduleByDay' => collect(array_fill_keys($this->schedule->weekdays(), collect())),
                'days' => $this->schedule->weekdays(),
                'weeklyClassCount' => 0,
                'subjectCount' => 0,
            ]);
        }

        return view('TeacherPanel.schedule', $this->schedule->forTeacher($teacher));
    }
}
