<?php

namespace App\Services;

use App\Models\Announcement;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\UploadedFile;

class AnnouncementService
{
    public const AUDIENCE_ALL = 0;
    public const AUDIENCE_ALL_STUDENTS = 2;
    public const AUDIENCE_ALL_TEACHERS = 3;
    public const AUDIENCE_BY_SUBJECT = 4;
    public const AUDIENCE_CUSTOM = 5;

    public function audienceFromTypes(array $types): int
    {
        if (in_array('all', $types, true)) {
            return self::AUDIENCE_ALL;
        }
        if (in_array('all_students', $types, true)) {
            return self::AUDIENCE_ALL_STUDENTS;
        }
        if (in_array('all_teachers', $types, true)) {
            return self::AUDIENCE_ALL_TEACHERS;
        }
        if (in_array('by_subject', $types, true)) {
            return self::AUDIENCE_BY_SUBJECT;
        }

        return self::AUDIENCE_CUSTOM;
    }

    public function forTeacher(Teacher $teacher, int $perPage = 10)
    {
        return Announcement::where('school_id', $teacher->school_id)
            ->where(function ($query) use ($teacher) {
                $query->whereIn('intended_audience', [self::AUDIENCE_ALL, self::AUDIENCE_ALL_TEACHERS])
                    ->orWhere('created_by', $teacher->id);
            })
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function forStudent(Student $student, int $perPage = 10)
    {
        return Announcement::where('school_id', $student->school_id)
            ->where(function ($query) use ($student) {
                $query->whereIn('intended_audience', [self::AUDIENCE_ALL, self::AUDIENCE_ALL_STUDENTS])
                    ->orWhere('class_available_id', $student->class_id);
            })
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function recentForTeacher(Teacher $teacher, int $limit = 3)
    {
        return $this->teacherFeedQuery($teacher)->latest()->limit($limit)->get();
    }

    public function countForTeacher(Teacher $teacher): int
    {
        return $this->teacherFeedQuery($teacher)->count();
    }

    public function canEdit(Teacher $teacher, Announcement $announcement): bool
    {
        return (int) $announcement->created_by === (int) $teacher->id;
    }

    public function create(Teacher $teacher, array $data, ?UploadedFile $attachment = null): Announcement
    {
        return Announcement::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'school_id' => $teacher->school_id,
            'created_by' => $teacher->id,
            'important_note' => $data['important_note'] ?? null,
            'intended_audience' => $this->audienceFromTypes($data['audience_type']),
            ...$this->attachmentFields($attachment),
        ]);
    }

    public function update(Announcement $announcement, array $data, ?UploadedFile $attachment = null): void
    {
        $payload = [
            'title' => $data['title'],
            'content' => $data['body'],
            'intended_audience' => $this->audienceFromTypes($data['edit_audience_type']),
        ];

        if ($attachment) {
            $payload = array_merge($payload, $this->attachmentFields($attachment));
        }

        $announcement->update($payload);
    }

    private function teacherFeedQuery(Teacher $teacher)
    {
        return Announcement::where('school_id', $teacher->school_id)
            ->where(function ($query) use ($teacher) {
                $query->whereIn('intended_audience', [self::AUDIENCE_ALL, self::AUDIENCE_ALL_TEACHERS])
                    ->orWhere('created_by', $teacher->id);
            });
    }

    private function attachmentFields(?UploadedFile $attachment): array
    {
        if (!$attachment) {
            return [
                'attachements' => null,
                'attachment_original_name' => null,
            ];
        }

        return [
            'attachements' => $attachment->store('attachments', 'public'),
            'attachment_original_name' => $attachment->getClientOriginalName(),
        ];
    }
}
