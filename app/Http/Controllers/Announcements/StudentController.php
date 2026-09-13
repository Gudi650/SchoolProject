<?php

namespace App\Http\Controllers\Announcements;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Student;

class StudentController extends Controller
{
    public function viewAnnouncements()
    {
        $student = Student::where('user_id', auth()->id())->first();

        if (!$student) {
            return view('StudentPanel.announcements', [
                'student' => null,
                'announcements' => null,
            ]);
        }

        $announcements = Announcement::where('school_id', $student->school_id)
            ->where(function ($query) use ($student) {
                $query->whereIn('intended_audience', [0, 2])
                    ->orWhere('class_available_id', $student->class_id);
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('StudentPanel.announcements', compact('student', 'announcements'));
    }
}
