<?php

namespace App\Livewire;

use App\Models\Attendance;
use Livewire\Component;

class SearchBar extends Component
{

    public $students;
    public $classId;
    public $schoolId;

    //search term
     public $searchTerm = '';

    public function render()
    {
        // Just dispatch the term, not the results
        $this->dispatch('searchResultsUpdated', term: $this->searchTerm);

        return view('livewire.search-bar');
    }

}
