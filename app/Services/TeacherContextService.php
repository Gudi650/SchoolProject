<?php

namespace App\Services;

use App\Models\AssignedRole;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class TeacherContextService
{
    public function loggedInTeacher(): ?Teacher
    {
        return Teacher::where('user_id', Auth::id())->first();
    }

    public function classTeacherAssignment(?Teacher $teacher): ?AssignedRole
    {
        if (!$teacher) {
            return null;
        }

        return AssignedRole::where('teacher_id', $teacher->id)
            ->whereRelation('teacherRole', 'name', 'Class Teacher')
            ->with('classAvailable')
            ->first();
    }

    public function isClassTeacher(?Teacher $teacher): bool
    {
        if (!$teacher) {
            return false;
        }

        return $teacher->assignedroles()->whereRelation('teacherRole', 'name', 'Class Teacher')->exists();
    }

    public function classTeacherClass(?Teacher $teacher): array
    {
        $class = $this->classTeacherAssignment($teacher)?->classAvailable;

        return [
            'classId' => $class?->id,
            'className' => $class?->name,
        ];
    }

    public function classStudents(?int $classId)
    {
        return $classId
            ? Student::where('class_id', $classId)->latest()->get()
            : collect();
    }
}
