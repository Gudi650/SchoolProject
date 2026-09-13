<?php

namespace App\Http\Controllers\Announcements;

use App\Http\Controllers\Controller;
use App\Services\AnnouncementService;
use App\Services\StudentContextService;

class StudentController extends Controller
{
    public function __construct(
        private StudentContextService $studentContext,
        private AnnouncementService $announcements,
    ) {
    }

    public function viewAnnouncements()
    {
        $student = $this->studentContext->loggedInStudent();

        if (!$student) {
            return view('StudentPanel.announcements', [
                'student' => null,
                'announcements' => null,
            ]);
        }

        return view('StudentPanel.announcements', [
            'student' => $student,
            'announcements' => $this->announcements->forStudent($student),
        ]);
    }
}
