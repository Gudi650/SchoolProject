<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AssignedSubject;
use App\Models\Assignment;
use App\Models\GeneratedTimetable;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();

        if (!$teacher) {
            return view('TeacherPanel.dashboard', ['teacher' => null]);
        }

        $schoolId = $teacher->school_id;
        $today = now()->format('l');

        $stats = [
            'students' => Student::where('school_id', $schoolId)->count(),
            'classes' => AssignedSubject::where('teacher_id', $teacher->id)->distinct('class_id')->count('class_id'),
            'assignments' => Assignment::where('teacher_id', $teacher->id)->count(),
            'announcements' => Announcement::where('school_id', $schoolId)
                ->where(function ($q) use ($teacher) {
                    $q->whereIn('intended_audience', [0, 3])->orWhere('created_by', $teacher->id);
                })->count(),
        ];

        $recentAnnouncements = Announcement::where('school_id', $schoolId)
            ->where(function ($q) use ($teacher) {
                $q->whereIn('intended_audience', [0, 3])->orWhere('created_by', $teacher->id);
            })
            ->latest()->limit(3)->get();

        $todaySchedule = GeneratedTimetable::with(['subject', 'classAvailable'])
            ->where('teacher_id', $teacher->id)
            ->where('day_of_week', $today)
            ->orderBy('start_time')
            ->get();

        $assignedClasses = AssignedSubject::with(['classAvailable', 'availablesubject'])
            ->where('teacher_id', $teacher->id)
            ->get()
            ->groupBy('class_id');

        return view('TeacherPanel.dashboard', compact(
            'teacher', 'stats', 'recentAnnouncements', 'todaySchedule', 'assignedClasses'
        ));
    }

    public function showSchedule()
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $scheduleByDay = collect(array_fill_keys($days, collect()));
        $weeklyClassCount = 0;
        $subjectCount = 0;

        if ($teacher) {
            $entries = GeneratedTimetable::with(['subject', 'classAvailable'])
                ->where('teacher_id', $teacher->id)
                ->orderBy('start_time')
                ->get();

            $weeklyClassCount = $entries->count();
            $subjectCount = $entries->pluck('subject_id')->unique()->count();

            foreach ($days as $day) {
                $scheduleByDay[$day] = $entries->where('day_of_week', $day)->values();
            }
        }

        return view('TeacherPanel.schedule', compact('scheduleByDay', 'days', 'weeklyClassCount', 'subjectCount'));
    }
}
