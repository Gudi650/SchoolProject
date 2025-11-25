<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\Student;
use Livewire\Component;

class Search extends Component
{
    //receive the data from the parent component
    public $students;
    public $schoolId;
    public $class_id;

    public $search = '';
    public $date = '';
    public $absent_students = [];
    
    // store search results for the view
    public $Searchedstudents;

    // keep Searchedstudents in sync when user types
    public function updatedSearch($value)
    {
        $value = trim($value);
        if ($value === '') {
            $this->Searchedstudents = collect();
            return;
        }

        $this->Searchedstudents = Student::where(function ($q) use ($value) {
            $q->where('fname', 'like', "%{$value}%")
              ->orWhere('mname', 'like', "%{$value}%")
              ->orWhere('lname', 'like', "%{$value}%");
        })
        ->when($this->schoolId, fn($q) => $q->where('school_id', $this->schoolId))
        ->when($this->class_id, fn($q) => $q->where('class_id', $this->class_id))
        ->get();
    }


    public function render()
    {
        // default empty results
        $Searchedstudents = $this->Searchedstudents ?? collect();
        // if search has content prefer the populated results
        if (strlen($this->search) > 0 && ($this->Searchedstudents ?? collect())->isNotEmpty()) {
            $Searchedstudents = $this->Searchedstudents;
        }
 
         //check if date is set 
         //if date is set then make sure the date is not already passed in the db for the class_id and school_id
         //then pop an error if attendance for that date is already registered
         if($this->date != ''){
             
            
             $existingAttendance = Attendance::where('date', $this->date)
                 ->where('school_id', $this->schoolId)
                 ->where('class-available_id', $this->class_id)
                 ->first();
         }
 
         //check if the existing attendance is found
         //pop an error message
         if(isset($existingAttendance)){
 
             session()->flash('error', 'Attendance for this date has already been recorded, Please cross-check the date you inserted.');
 
             //empty the searched students collection
             $Searchedstudents = collect();
 
             //redirect back to the attendance page
             $this->redirectRoute('teacher.registerstudentattendance.view'); 
 
         }
 
         //now pass the date variable to the view along with searched students
         return view('livewire.search', [
             'Searchedstudents' => $Searchedstudents,
         ]);
    }
}
