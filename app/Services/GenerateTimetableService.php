<?php

namespace App\Services;

use Carbon\Carbon;


class GenerateTimetableService
{

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
        $classes = $data['classes'];
        $schoolId = $data['schoolId'];
        $subjects = $data['subjects'];

        // maximum times a subject may appear per week (for testing)
        $max_periods_times = 2;

        // times a subject appeared array (per class)
        $appearence_per_subject = [];

        // days of the week we will generate (simple 5-day week)
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        // get day exceptions from validated data (allow entries like "Friday" or "Friday: 09:00 - 12:00")
        $exceptions_input = $validatedData['days_exceptions'] ?? [];
        $exceptions_days = [];
        foreach ($exceptions_input as $entry) {
            // if user supplied "Day: times" keep only the day name
            $parts = explode(':', $entry, 2);
            $exceptions_days[] = trim($parts[0]);
        }

        //get the exceptions periods per day from validated data
        $exceptions_periods = $validatedData['periods_days_exceptions'] ?? [];

        // build associative map for periods-per-day exceptions, e.g. ['Friday' => 4]
        $exceptions_periods_assoc = [];
        foreach ($exceptions_periods as $exception) {
            $parts = explode(':', $exception, 2);
            if (count($parts) === 2) {
                $day = trim($parts[0]);
                $periods = (int) trim($parts[1]);
                $exceptions_periods_assoc[$day] = $periods;
            }
        }

        $timetable = [];

        // priority subject ids (optional)
        $prioritySubjects_id = $validatedData['priority_subjects'] ?? [];

        // loop classes
        foreach ($classes as $class) {
            // ensure appearance tracking for this class exists
            $appearence_per_subject[$class->id] = $appearence_per_subject[$class->id] ?? [];

            // loop days
            foreach ($daysOfWeek as $day) {


                // Basic time calculation for the day
                $totalHours = $this->calculateHours($validatedData);
                // Accept either `PeriodPerDay` (form field) or `periods_per_day` (alternate key)
                $periodsPerDay = (int) ($validatedData['PeriodPerDay'] ?? $validatedData['periods_per_day'] ?? 0);
                if ($periodsPerDay <= 0) {
                    throw new \InvalidArgumentException('Invalid periods per day value');
                }
                // duration per period in hours (could be float, e.g. 0.75)
                $durationPerPeriod = $totalHours / $periodsPerDay;

                $timetable[$class->id][$day] = [];

                // reset per-day used subjects so the same subject doesn't repeat in the same day
                $used_subjects = [];

                // randomize subject order each day (subjects is an Eloquent Collection)
                $shuffledSubjects = $subjects->shuffle();

                // build a per-day priority order by rotating the priority list
                // this makes priority subjects appear first but in a different order each day
                // build a rotated priority list for this day so priority subjects change order each day
                $dayIndex = array_search($day, $daysOfWeek);
                $dayPriority = $prioritySubjects_id;
                if (!empty($dayPriority)) {
                    $countP = count($dayPriority);
                    $offset = ($dayIndex === false) ? 0 : ($dayIndex % $countP);
                    $dayPriority = array_merge(
                        array_slice($dayPriority, $offset),
                        array_slice($dayPriority, 0, $offset)
                    );
                }

                // If this day is an exception, adjust the periods for the day
                if (in_array($day, $exceptions_days)) {
                    $periodsPerDay = $exceptions_periods_assoc[$day] ?? $periodsPerDay;
                    if ($periodsPerDay <= 0) {
                        throw new \InvalidArgumentException('Invalid periods per day value for exception day: ' . $day);
                    }
                    // recalc duration for this day's periods
                    $durationPerPeriod = $totalHours / $periodsPerDay;
                }
                
                for ($period = 1; $period <= $periodsPerDay; $period++) {
                    $assigned = null;
                   
                    // helper: find first subject satisfying conditions
                    // helper: find the first available subject object that hasn't exceeded max weekly appearances
                    $findAvailable = function($excludeUsed = true) use ($shuffledSubjects, &$appearence_per_subject, $class, $max_periods_times, $used_subjects) {
                        foreach ($shuffledSubjects as $subj) {
                            $count = $appearence_per_subject[$class->id][$subj->id] ?? 0;
                            if ($count >= $max_periods_times) {
                                continue; // subject exhausted for this class
                            }
                            if ($excludeUsed && in_array($subj->id, $used_subjects)) {
                                continue; // already scheduled earlier this day
                            }
                            return $subj;
                        }
                        return null;
                    };
                    
                    // if priority exists and this period is within priority count, attempt to use that priority subject
                    if (!empty($dayPriority) && $period <= count($dayPriority)) {
                        // use the rotated per-day priority order
                        $priorityId = $dayPriority[$period - 1] ?? null;

                            if ($priorityId) {
                                // try to select the priority subject object from the shuffled list
                                $prioritySub = $shuffledSubjects->firstWhere('id', $priorityId);
                                $priorityCount = $appearence_per_subject[$class->id][$priorityId] ?? 0;
                                if ($prioritySub && $priorityCount < $max_periods_times && !in_array($priorityId, $used_subjects)) {
                                    $assigned = $prioritySub;
                                } else {
                                    // fallback to any available subject
                                    $assigned = $findAvailable(true) ?: $findAvailable(false);
                                }
                            }
                    } else {
                        // normal period: pick any available subject not used today and under max
                        $assigned = $findAvailable(true);
                        if (! $assigned) {
                            //allow reuse within day if still under max
                            $assigned = $findAvailable(false);
                        }
                    }

                    // if still nothing available -> assign null for this period
                    if (! $assigned) {
                        $timetable[$class->id][$day][] = [
                            'period' => $period,
                            'subject_id' => null,
                            'duration' => $durationPerPeriod,
                        ];
                        continue;
                    }

                    // record assignment and increment appearance counters
                    $timetable[$class->id][$day][] = [
                        'period' => $period,
                        'subject_id' => $assigned->id,
                        'duration' => $durationPerPeriod,
                        'subject_name' => $assigned->subject_name ?? $assigned->name ?? null,
                    ];

                    // mark subject as used this day (prevents immediate repeat)
                    $used_subjects[] = $assigned->id;

                    // increment the weekly appearance counter for this class
                    $appearence_per_subject[$class->id][$assigned->id] = ($appearence_per_subject[$class->id][$assigned->id] ?? 0) + 1;
                }
            }
        }

        return $timetable;
    }



}