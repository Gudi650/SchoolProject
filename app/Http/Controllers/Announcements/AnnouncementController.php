<?php

namespace App\Http\Controllers\Announcements;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Services\AnnouncementService;
use App\Services\TeacherContextService;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function __construct(
        private TeacherContextService $teacherContext,
        private AnnouncementService $announcements,
    ) {
    }

    public function viewAnnouncements()
    {
        $teacher = $this->teacherContext->loggedInTeacher();

        if (!$teacher) {
            return view('TeacherPanel.announcements', [
                'subjects' => collect(),
                'announcements' => null,
                'teacherId' => null,
            ]);
        }

        return view('TeacherPanel.announcements', [
            'subjects' => $this->teacherContext->subjects($teacher),
            'announcements' => $this->announcements->forTeacher($teacher),
            'teacherId' => $teacher->id,
        ]);
    }

    public function addAnnouncement(Request $request)
    {
        $teacher = $this->teacherContext->requireTeacher();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'audience_type' => 'required|array|min:1',
            'important_note' => 'nullable|string',
            'audience_type.*' => 'required|in:all_students,all_teachers,all,by_subject',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        $this->announcements->create($teacher, $data, $request->file('attachment'));

        return redirect()->back()->with('success', 'Announcement created successfully.');
    }

    public function updateAnnouncement(Request $request)
    {
        $teacher = $this->teacherContext->requireTeacher();

        $data = $request->validate([
            'announcement_id' => 'required|exists:announcements,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'edit_audience_type' => 'required|array|min:1',
            'edit_audience_type.*' => 'required|in:all_students,all_teachers,all,by_subject',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        $announcement = Announcement::findOrFail($data['announcement_id']);

        if (!$this->announcements->canEdit($teacher, $announcement)) {
            return redirect()->back()->with('error', 'You are not authorized to update this announcement.');
        }

        $this->announcements->update($announcement, $data, $request->file('attachment'));

        return redirect()->back()->with('success', 'Announcement updated successfully.');
    }
}
