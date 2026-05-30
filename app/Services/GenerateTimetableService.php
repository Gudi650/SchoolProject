<?php

namespace App\Services;

use Carbon\Carbon;


class GenerateTimetableService
{
    private const DAYS_OF_WEEK = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    private const DEFAULT_MAX_APPEARANCES = 2;

    /**
     * Calculate the total number of hours in a school day.
     * Expects `class_times` in the format "HH:MM - HH:MM" (spaces optional).
     * Returns a float or int representing hours (e.g. 6 or 6.5).
     *
     * @param array $validatedData
     * @return float|int
     */
    public function calculateHours(array $validatedData)
    {
        // Example input: "09:00 - 15:00" or "09:00-15:00"
        $parts = explode('-', $validatedData['class_times']);
        if (count($parts) < 2) {
            throw new \InvalidArgumentException('Invalid class_times format. Use "HH:MM - HH:MM"');
        }

        $start = trim($parts[0]);
        $end = trim($parts[1]);

        // Use Carbon to parse times; using H:i format (24-hour)
        $startTime = Carbon::createFromFormat('H:i', $start);
        $endTime = Carbon::createFromFormat('H:i', $end);

        // Return decimal hours (difference in minutes / 60) to handle non-integer durations
        $minutes = $startTime->diffInMinutes($endTime);
        return $minutes / 60;
    }

    //function to auto generate timetable
    public function generateTimetable(array $validatedData , array $data)
    {
        // Main entry point for timetable generation.
        // - $validatedData contains the user inputs from the form
        // - $data contains the centralised school data from the controller
        // The method creates a timetable per class while avoiding teacher clashes.

        $classes = $data['classes'];
        $subjects = $data['subjects'];
        $assignedSubjects = $data['assignedSubjects'] ?? collect();

        // Build a fast lookup structure for assigned subjects and teachers.
        $classAssignments = $this->buildAssignedSubjectMap($assignedSubjects);
        $prioritySubjects = array_map('intval', $validatedData['priority_subjects'] ?? []);
        $exceptionsDays = $this->normalizeDayExceptions($validatedData['days_exceptions'] ?? []);
        $exceptionsPeriods = $this->normalizePeriodsExceptions($validatedData['periods_days_exceptions'] ?? []);
        $defaultPeriodsPerDay = (int) ($validatedData['PeriodPerDay'] ?? $validatedData['periods_per_day'] ?? 0);

        if ($defaultPeriodsPerDay <= 0) {
            throw new \InvalidArgumentException('Invalid periods per day value');
        }

        // Total teaching hours available in one school day.
        $totalHours = $this->calculateHours($validatedData);
        $teacherBusy = [];
        $subjectAppearance = [];
        $timetable = [];

        // loop classes
        foreach ($classes as $class) {
            $subjectAppearance[$class->id] = $subjectAppearance[$class->id] ?? [];
            // Candidate pool contains assigned subjects first, then any remaining subjects.
            $classCandidatePool = $this->buildCandidatePool($class->id, $classAssignments, $subjects);

            foreach (self::DAYS_OF_WEEK as $dayIndex => $day) {
                $periodsPerDay = $exceptionsDays[$day] ?? $defaultPeriodsPerDay;

                if ($periodsPerDay <= 0) {
                    throw new \InvalidArgumentException('Invalid periods per day value for ' . $day);
                }

                // Recalculate period duration for this day based on the number of periods.
                $durationPerPeriod = $totalHours / $periodsPerDay;

                // Rotate priority subjects so the order changes by day.
                $dayPriority = $this->rotatePrioritySubjects($prioritySubjects, $dayIndex);

                // Prevent the same subject from repeating too often in the same day.
                $usedSubjectIds = [];

                // Randomize candidate order to spread subjects more evenly.
                $shuffledCandidates = $this->shuffleCandidates($classCandidatePool);

                $timetable[$class->id][$day] = [];

                for ($periodIndex = 0; $periodIndex < $periodsPerDay; $periodIndex++) {
                    // Choose the best candidate that does not break any rule.
                    $selected = $this->selectCandidate(
                        $shuffledCandidates,
                        $dayPriority,
                        $periodIndex,
                        $usedSubjectIds,
                        $day,
                        $periodIndex,
                        $teacherBusy,
                        $subjectAppearance,
                        $class->id,
                        self::DEFAULT_MAX_APPEARANCES
                    );

                    // If nothing fits, store an empty slot so the table still keeps its structure.
                    if ($selected === null) {
                        $timetable[$class->id][$day][] = $this->buildEmptySlot($periodIndex + 1, $durationPerPeriod);
                        continue;
                    }

                    $timetable[$class->id][$day][] = $this->buildSlot($selected, $periodIndex + 1, $durationPerPeriod);

                    $usedSubjectIds[] = $selected['subject_id'];
                    $subjectAppearance[$class->id][$selected['subject_id']] = ($subjectAppearance[$class->id][$selected['subject_id']] ?? 0) + 1;

                    // Mark the teacher as occupied for this day/period.
                    if (!empty($selected['teacher_id'])) {
                        $teacherBusy[$day][$periodIndex][$selected['teacher_id']] = $class->id;
                    }
                }
            }
        }

        return $timetable;
    }

    protected function buildAssignedSubjectMap($assignedSubjects): array
    {
        $indexed = [];

        foreach ($assignedSubjects as $assignment) {
            $classId = $assignment->class_id;
            $subjectId = $assignment->availablesubject_id;

            // Store the teacher and subject info together for quick access during scheduling.
            $indexed[$classId][$subjectId] = [
                'class_id' => $classId,
                'subject_id' => $subjectId,
                'subject_name' => $assignment->availablesubject->name ?? $assignment->availablesubject->subject_name ?? null,
                'teacher_id' => $assignment->teacher_id,
                'teacher_name' => $this->formatTeacherName($assignment->teacher),
            ];
        }

        return $indexed;
    }

    protected function buildCandidatePool(int $classId, array $classAssignments, $subjects): array
    {
        // Begin with subjects already assigned to this class.
        $pool = array_values($classAssignments[$classId] ?? []);
        $assignedSubjectIds = array_column($pool, 'subject_id');

        // Add the remaining school subjects as fallback candidates.
        foreach ($subjects as $subject) {
            if (in_array($subject->id, $assignedSubjectIds, true)) {
                continue;
            }

            $pool[] = [
                'class_id' => $classId,
                'subject_id' => $subject->id,
                'subject_name' => $subject->name ?? $subject->subject_name ?? null,
                'teacher_id' => null,
                'teacher_name' => null,
            ];
        }

        return $pool;
    }

    protected function shuffleCandidates(array $candidates): array
    {
        shuffle($candidates);

        return $candidates;
    }

    protected function rotatePrioritySubjects(array $prioritySubjects, int $dayIndex): array
    {
        if (empty($prioritySubjects)) {
            return [];
        }

        $count = count($prioritySubjects);
        $offset = $count > 0 ? ($dayIndex % $count) : 0;

        return array_merge(
            array_slice($prioritySubjects, $offset),
            array_slice($prioritySubjects, 0, $offset)
        );
    }

    protected function selectCandidate(
        array $candidates,
        array $prioritySubjects,
        int $periodNumber,
        array $usedSubjectIds,
        string $day,
        int $periodIndex,
        array &$teacherBusy,
        array &$subjectAppearance,
        int $classId,
        int $maxAppearances
    ): ?array {
        $orderedCandidates = $this->prioritizeCandidates($candidates, $prioritySubjects, $periodNumber);

        foreach ($orderedCandidates as $candidate) {
            $subjectId = $candidate['subject_id'];
            $teacherId = $candidate['teacher_id'];

            if (in_array($subjectId, $usedSubjectIds, true)) {
                continue;
            }

            if (($subjectAppearance[$classId][$subjectId] ?? 0) >= $maxAppearances) {
                continue;
            }

            if ($teacherId !== null && isset($teacherBusy[$day][$periodIndex][$teacherId])) {
                continue;
            }

            return $candidate;
        }

        return null;
    }

    protected function prioritizeCandidates(array $candidates, array $prioritySubjects, int $periodNumber): array
    {
        if (empty($prioritySubjects)) {
            return $candidates;
        }

        $prioritySet = [];
        if ($periodNumber < count($prioritySubjects)) {
            $prioritySet[] = $prioritySubjects[$periodNumber];
        }

        $priority = [];
        $rest = [];

        foreach ($candidates as $candidate) {
            if (in_array($candidate['subject_id'], $prioritySet, true)) {
                $priority[] = $candidate;
                continue;
            }

            $rest[] = $candidate;
        }

        return array_merge($priority, $rest);
    }

    protected function buildSlot(array $candidate, int $periodNumber, float $durationPerPeriod): array
    {
        return [
            'period' => $periodNumber,
            'subject_id' => $candidate['subject_id'],
            'duration' => $durationPerPeriod,
            'subject_name' => $candidate['subject_name'],
            'teacher_id' => $candidate['teacher_id'],
            'teacher_name' => $candidate['teacher_name'],
        ];
    }

    protected function buildEmptySlot(int $periodNumber, float $durationPerPeriod): array
    {
        return [
            'period' => $periodNumber,
            'subject_id' => null,
            'duration' => $durationPerPeriod,
            'subject_name' => null,
            'teacher_id' => null,
            'teacher_name' => null,
        ];
    }

    protected function normalizeDayExceptions(array $exceptions): array
    {
        $normalized = [];

        foreach ($exceptions as $entry) {
            $parts = explode(':', $entry, 2);
            $normalized[trim($parts[0])] = true;
        }

        return $normalized;
    }

    protected function normalizePeriodsExceptions(array $exceptions): array
    {
        $normalized = [];

        foreach ($exceptions as $entry) {
            $parts = explode(':', $entry, 2);

            if (count($parts) === 2) {
                $normalized[trim($parts[0])] = (int) trim($parts[1]);
            }
        }

        return $normalized;
    }

    protected function formatTeacherName($teacher): ?string
    {
        if (! $teacher) {
            return null;
        }

        return trim(implode(' ', array_filter([
            $teacher->fname ?? null,
            $teacher->mname ?? null,
            $teacher->lname ?? null,
        ])));
    }



}