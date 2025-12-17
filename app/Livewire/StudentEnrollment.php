<?php

namespace App\Livewire;

use Livewire\Component;

class StudentEnrollment extends Component
{
    public int $step = 1;
    public $schools;

    //step 1: Personal Information
    public $fname;
    public $mname;
    public $lname;
    public $dob;
    public $gender;
    public $school_id;

    //step 2: Contact Information
    public $ward;
    public $city;
    public $district;
    public $street;
    public $phone;
    public $email; 

    //step 3: Guardian Information
    public $firstname;
    public $middlename;
    public $lastname;
    public $guardian_phone;
    public $guardian_email;
    public $relationship;

    //step 4: Academic Information
    public $grade_applied_for;
    public $previous_school_name;
    public $previous_grades;
    public $admission_date;

    //step 5: Documents Upload
    public $academic_records;
    public $reports_cards;
    public $transfer_certificate;
    public $birth_certificate;


    public function nextStep()
    {
        if($this->step < 6){
            $this->step++;
        }
    }

    public function previousStep()
    {
        if($this->step > 1){
            $this->step--;
        }
    }



    public function render()
    {
        return view('livewire.student-enrollment');
    }
}
