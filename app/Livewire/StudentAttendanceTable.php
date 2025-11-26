<?php

namespace App\Livewire;

use App\Models\Attendance;
use Livewire\Component;
use Livewire\WithPagination;

class StudentAttendanceTable extends Component
{
    use WithPagination;

    public $studentz = [];
    public $classId;
    public $schoolId;

    // Tell Livewire: when 'searchResultsUpdated' is emitted, call updateResults()
    protected $listeners = ['searchResultsUpdated' => 'updateResults'];

    public function updateResults($results)
    {
        // Receive the data here
        $this->studentz = $results;
    }

    public function render()
    {
        return view('livewire.student-attendance-table', [
            'students' => Attendance::where('school_id', $this->schoolId)
                                    ->where('class-available_id', $this->classId)
                                    ->with('student')
                                    ->paginate(10) // show 10 per page
        ]);
    }

}



    

