<?php

namespace App\Services;

use Carbon\Carbon;


class GenerateTimetableService
{

    //function to calculate the hours in a day
    public function calculateHours(array $validatedData){

        //get teh start and end time
        [$start, $end] = explode('-', $validatedData['class_times']);

        // Trim spaces in the variables
        $start = trim($start);
        $end   = trim($end);

        // Parse times with Carbon
        $startTime = Carbon::createFromFormat('H:i', $start);
        $endTime   = Carbon::createFromFormat('H:i', $end);

        // Get difference in hours
        $hours = $startTime->diffInHours($endTime);
        

        return $hours;
    }

    //function to auto generate timetable
    public function generateTimetable(array $validatedData , array $data)
    {
        $classes = $data['classes'];
        $schoolId = $data['schoolId'];
        $subjects = $data['subjects'];

        // maximum times a subject may appear per week (for testing)
        $max_periods_times = 3;

        // times a subject appeared array (per class)
        $appearence_per_subject = [];

        // days of the week
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday','Friday'];

        $timetable = [];

        // duration calculation (keeps existing behaviour)
        $totalHours = $this->calculateHours($validatedData);
        $periodsPerDay = (int) ($validatedData['PeriodPerDay'] ?? $validatedData['periods_per_day'] ?? 0);
        if ($periodsPerDay <= 0) {
            throw new \InvalidArgumentException('Invalid periods per day value');
        }
        $durationPerPeriod = $totalHours / $periodsPerDay;

        // priority subject ids (optional)
        $prioritySubjects_id = $validatedData['priority_subjects'] ?? [];

        // loop classes
        foreach ($classes as $class) {
            // ensure appearance tracking for this class exists
            $appearence_per_subject[$class->id] = $appearence_per_subject[$class->id] ?? [];

            foreach ($daysOfWeek as $day) {
                $timetable[$class->id][$day] = [];

                // reset per-day used subjects so priority subjects may reappear next day
                $used_subjects = [];

                // randomize subject order each day
                $shuffledSubjects = $subjects->shuffle();

                // build a per-day priority order by rotating the priority list
                // this makes priority subjects appear first but in a different order each day
                $dayIndex = array_search($day, $daysOfWeek);
                $dayPriority = $prioritySubjects_id;
                if (!empty($dayPriority)) {
                    $countP = count($dayPriority);
                    // rotate by day index (deterministic variation)
                    $offset = $dayIndex % $countP;
                    $dayPriority = array_merge(
                        array_slice($dayPriority, $offset),
                        array_slice($dayPriority, 0, $offset)
                    );
                }
                
                for ($period = 1; $period <= $periodsPerDay; $period++) {
                    $assigned = null;
                   
                    // helper: find first subject satisfying conditions
                    $findAvailable = function($excludeUsed = true) use (&$shuffledSubjects, &$appearence_per_subject, $class, $max_periods_times, $used_subjects) {
                        foreach ($shuffledSubjects as $subj) {
                            $count = $appearence_per_subject[$class->id][$subj->id] ?? 0;
                            if ($count >= $max_periods_times) {
                                continue; // subject exhausted
                            }
                            if ($excludeUsed && in_array($subj->id, $used_subjects)) {
                                continue; // already used this day
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

                            // find priority subject object

                            $prioritySub = $shuffledSubjects->firstWhere('id', $priorityId);

                            // check priority subject exists and hasn't exceeded max
                            $priorityCount = $appearence_per_subject[$class->id][$priorityId] ?? 0;
                            if ($prioritySub && $priorityCount < $max_periods_times && !in_array($priorityId, $used_subjects)) {

                                $assigned = $prioritySub;

                            } else {

                                // fallback: pick any available subject (prefer unused today)
                                $assigned = $findAvailable(true);

                                if (! $assigned) {

                                    // allow subjects used today but still under max
                                    $assigned = $findAvailable(false);

                                }
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
                        'subject_name' => $assigned->subject_name ?? null,
                    ];

                    // mark used for the day
                    $used_subjects[] = $assigned->id;

                    // increment appearance count for this class
                    $appearence_per_subject[$class->id][$assigned->id] = ($appearence_per_subject[$class->id][$assigned->id] ?? 0) + 1;
                }
            }
        }

        return $timetable;
    }



}