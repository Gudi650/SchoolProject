<?php

namespace App\Http\Controllers;

use App\Models\GeneratedTimetable;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
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
