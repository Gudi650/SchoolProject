<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentContextService
{
    public function loggedInStudent(): ?Student
    {
        $user = Auth::user();

        return $user?->students ?? Student::where('user_id', Auth::id())->first();
    }

    public function schoolId(?Student $student = null): ?int
    {
        return ($student ?? $this->loggedInStudent())?->school_id;
    }

    public function classId(?Student $student = null): ?int
    {
        return ($student ?? $this->loggedInStudent())?->class_id;
    }

    public function requireStudent(): Student
    {
        $student = $this->loggedInStudent();
        abort_if(!$student, 403);

        return $student;
    }

    public function authorizeStudent(int $studentId): void
    {
        abort_if($this->loggedInStudent()?->id !== $studentId, 403);
    }
}
