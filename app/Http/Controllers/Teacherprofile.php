<?php

namespace App\Http\Controllers;

use App\Services\TeacherContextService;
use Illuminate\Http\Request;

class Teacherprofile extends Controller
{
    public function __construct(private TeacherContextService $teacherContext)
    {
    }

    public function showProfile()
    {
        return view('TeacherPanel.profile', [
            'teacher' => $this->teacherContext->loggedInTeacher(),
            'user' => auth()->user(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'email|max:255',
            'phone' => 'string|max:15',
        ]);

        $teacher = $this->teacherContext->loggedInTeacher();

        if ($teacher) {
            $updateData = array_filter([
                'email' => $validatedData['email'] ?? null,
                'phone' => $validatedData['phone'] ?? null,
            ], fn ($v) => $v !== null);

            if ($updateData) {
                $teacher->update($updateData);
            }
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
