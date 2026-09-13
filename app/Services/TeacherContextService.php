<?php

namespace App\Services;

use App\Models\AssignedRole;
use App\Models\AssignedSubject;
use App\Models\ClassAvailable;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\availablesubject;
use Illuminate\Support\Facades\Auth;

class TeacherContextService
{
    public function loggedInTeacher(): ?Teacher
    {
        return Teacher::where('user_id', Auth::id())->first();
    }

    public function requireTeacher(): Teacher
    {
        $teacher = $this->loggedInTeacher();
        abort_if(!$teacher, 403);

        return $teacher;
    }

    public function schoolId(?Teacher $teacher = null): ?int
    {
        return ($teacher ?? $this->loggedInTeacher())?->school_id;
    }

    public function subjects(?Teacher $teacher = null)
    {
        $schoolId = $this->schoolId($teacher);

        return $schoolId
            ? availablesubject::where('school_id', $schoolId)->get()
            : collect();
    }

    public function schoolClasses(?int $schoolId = null)
    {
        $schoolId ??= $this->schoolId();

        return $schoolId
            ? ClassAvailable::where('school_id', $schoolId)->orderBy('name')->get()
            : collect();
    }

    public function schoolTeachers(?int $schoolId = null)
    {
        $schoolId ??= $this->schoolId();

        return $schoolId
            ? Teacher::where('school_id', $schoolId)->get()
            : collect();
    }

    public function assignedSubjectsFor(?Teacher $teacher = null)
    {
        $teacher ??= $this->loggedInTeacher();

        if (!$teacher) {
            return collect();
        }

        return AssignedSubject::with('classAvailable')
            ->where('school_id', $teacher->school_id)
            ->where('teacher_id', $teacher->id)
            ->get();
    }

    public function resolveSchoolId($user = null): ?int
    {
        $user ??= Auth::user();

        if (!$user) {
            return session('school_id');
        }

        return $user->school_id
            ?? Teacher::where('user_id', $user->id)->value('school_id')
            ?? session('school_id');
    }

    public function timetableSetup(?Teacher $teacher = null): array
    {
        $teacher ??= $this->loggedInTeacher();
        $schoolId = $this->schoolId($teacher);

        return [
            'teacher' => $teacher,
            'schoolId' => $schoolId,
            'classes' => $this->schoolClasses($schoolId),
            'subjects' => $this->subjects($teacher),
        ];
    }

    public function assignedClasses(?Teacher $teacher = null)
    {
        $teacher ??= $this->loggedInTeacher();

        if (!$teacher) {
            return collect();
        }

        return AssignedSubject::with(['classAvailable', 'availablesubject'])
            ->where('teacher_id', $teacher->id)
            ->get()
            ->groupBy('class_id');
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

    public function attendanceContext(): array
    {
        $teacher = $this->loggedInTeacher();
        $class = $this->classTeacherClass($teacher);

        return [
            'teacher' => $teacher,
            'schoolId' => $teacher?->school_id,
            'classId' => $class['classId'],
            'className' => $class['className'],
            'students' => $this->classStudents($class['classId']),
        ];
    }
}
