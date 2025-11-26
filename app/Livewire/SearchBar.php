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
        $results = collect();

        if (strlen($this->searchTerm) > 0) {
            if ($this->students && $this->students instanceof \Illuminate\Support\Collection) {
                $term = $this->searchTerm;

                $results = $this->students->filter(function ($item) use ($term) {
                    // support both: Student model items or Attendance items with relation 'student'
                    $fname = $item->name ?? $item->student->fname ?? '';
                    $lname = $item->lname ?? $item->student->lname ?? '';
                    $mname = $item->mname ?? $item->student->mname ?? '';
                    $name = trim("$fname $mname $lname");
                    $admission = $item->admission_number ?? $item->student->admission_number ?? '';
                    $note = $item->note ?? '';

                    // case-insensitive search
                    return (stripos($name, $term) !== false)
                        || (stripos($admission, $term) !== false)
                        || (stripos($note, $term) !== false);
                })->values();

                //dispatch the results to be used in the table component
                 $this->dispatch('searchResultsUpdated', results: $results);

            }
        } else {

            $results = $this->students ?? collect();
            //dispatch the full list when search term is cleared
            $this->dispatch('searchResultsUpdated', results: $results);

        }

        return view('livewire.search-bar', ['results' => $results]);
    }
}
