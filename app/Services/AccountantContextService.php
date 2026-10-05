<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountantContextService
{
    public function resolveSchoolIdForUser(?User $user): ?int
    {
        if (!$user) {
            return session('school_id');
        }

        $fromProfile = Teacher::where('user_id', $user->id)->value('school_id')
            ?? Student::where('user_id', $user->id)->value('school_id')
            ?? Employee::where('email', $user->email)->value('school_id');

        return $fromProfile ?? session('school_id');
    }

    public function syncSchoolSession(?User $user = null): void
    {
        $user ??= Auth::user();

        if (!$user) {
            return;
        }

        $schoolId = $this->resolveSchoolIdForUser($user);

        if ($schoolId) {
            session(['school_id' => $schoolId]);
        }
    }

    public function resolveSchoolId(): ?int
    {
        return $this->resolveSchoolIdForUser(Auth::user());
    }
}
