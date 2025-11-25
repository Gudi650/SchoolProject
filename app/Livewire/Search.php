<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;

class Search extends Component
{
    //receive the data from the parent component
    public $students;
    public $schoolId;
    public $class_id;

    public $search = '';
    public $date = null;

   /* protected $listeners = [
        'dateUpdated' => 'setDate',
    ];

    public function setDate($value)
    {
        $this->date = $value;
    } */

    public function render()
    {
        //initialize the searched students array
        $Searchedstudents = collect();

        //check if search is not empty
        if(strlen($this->search) > 0){
           

            //filter the students based on the search term and store in a variable
           $Searchedstudents = Student::where(function ($query) {
            $query->where('fname', 'like', "%{$this->search}%")
              ->orWhere('mname', 'like', "%{$this->search}%")
              ->orWhere('lname', 'like', "%{$this->search}%");
            })
            ->where('school_id', $this->schoolId)
            ->where('class_id', $this->class_id)
            ->get();


        }

        return view('livewire.search',[
            'Searchedstudents' => $Searchedstudents,
        ]);
    }
}
