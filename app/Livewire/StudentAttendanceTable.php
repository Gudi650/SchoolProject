<?php

namespace App\Livewire;

use App\Models\Attendance;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentAttendanceTable extends Component
{
    use WithPagination;

    public $classId;
    public $schoolId;
    public $searchTerm = '';

    protected $listeners = ['searchResultsUpdated' => 'updateSearchTerm'];

    public function updateSearchTerm($term)
    {
        $this->searchTerm = $term;
        $this->resetPage(); // reset pagination when searching
    }

    public function render()
    {
        $query = Attendance::where('school_id', $this->schoolId)
        ->where('class-available_id', $this->classId)
        ->with('student');

    // If a search term exists, filter
    if ($this->searchTerm) {
        $query->where(function ($q) {
            $q->whereHas('student', function ($q2) {
                $q2->where('fname', 'like', "%{$this->searchTerm}%")
                   ->orWhere('lname', 'like', "%{$this->searchTerm}%")
                   ->orWhere('mname', 'like', "%{$this->searchTerm}%");
                   //->orWhere('admission_number', 'like', "%{$this->searchTerm}%");
            });
            //->orWhere('note', 'like', "%{$this->searchTerm}%");
        });
    }

    return view('livewire.student-attendance-table', [
        'students' => $query->paginate(10), // always a paginator
    ]);

    }

}





