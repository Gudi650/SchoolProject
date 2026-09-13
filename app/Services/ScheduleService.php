<?php

namespace App\Services;

use App\Models\GeneratedTimetable;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Collection;

class ScheduleService
{
    public function weekdays(): array
    {
        return ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    }

    public function forClass(Student $student): Collection
    {
        $days = $this->weekdays();
        $grouped = collect();

        if ($student->class_id) {
            $entries = GeneratedTimetable::with(['subject', 'teacher'])
                ->where('class_id', $student->class_id)
                ->where('school_id', $student->school_id)
                ->orderBy('start_time')
                ->get()
                ->groupBy('day_of_week');

            foreach ($days as $day) {
                $grouped[$day] = $entries->get($day, collect());
            }
        } else {
            foreach ($days as $day) {
                $grouped[$day] = collect();
            }
        }

        return $grouped;
    }

    public function forTeacher(Teacher $teacher): array
    {
        $days = $this->weekdays();
        $scheduleByDay = collect(array_fill_keys($days, collect()));
        $weeklyClassCount = 0;
        $subjectCount = 0;

        $entries = GeneratedTimetable::with(['subject', 'classAvailable'])
            ->where('teacher_id', $teacher->id)
            ->orderBy('start_time')
            ->get();

        $weeklyClassCount = $entries->count();
        $subjectCount = $entries->pluck('subject_id')->unique()->count();

        foreach ($days as $day) {
            $scheduleByDay[$day] = $entries->where('day_of_week', $day)->values();
        }

        return compact('scheduleByDay', 'days', 'weeklyClassCount', 'subjectCount');
    }

    public function todayForTeacher(Teacher $teacher)
    {
        return GeneratedTimetable::with(['subject', 'classAvailable'])
            ->where('teacher_id', $teacher->id)
            ->where('day_of_week', now()->format('l'))
            ->orderBy('start_time')
            ->get();
    }
}
