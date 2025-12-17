<?php

namespace App\Livewire;

use League\Config\Exception\ValidationException;
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

    //property to handle same as student info
    public $sameAsStudent = false;


    public function nextStep()
    {
        //validate the current step before moving to the next
        match($this->step)
        {
            1 => $this->validatestep1(),
            2 => $this->validatestep2(),
            3 => $this->validatestep3(),
            4 => $this->validatestep4(),
            5 => $this->validatestep5(),
            default => null,
        }; 

        //after validation increment the step
        if($this->step < 6){

            //make the delay to simulate processing time
            sleep(2);

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


    //protected function to validate different steps

    //validate the first step here
    protected function validatestep1()
    {
        //create a try and catch block to handle validation errors
        try
        {

            $validated = $this->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string|in:male,female,other',
            'school_id' => 'required|exists:schools,id',
            ]);

        }catch(ValidationException $e)
        {
            //handle the validation exception
            $this->addError('validation', 'Please correct the errors in the form.');
            throw $e;
        }

        

        
    }

    //validate the second step
    protected function validatestep2()
    {
        $this->validate([
            'ward' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'street' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^\+?[0-9]{7,15}$/'],
            'email' => 'required|email|max:255',
        ]);

    }

    //validate the third step
    protected function validatestep3()
    {
        $this->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:15',
            'guardian_email' => 'required|email|max:255',
            'relationship' => 'required|string|max:100',
        ]);

    }

    //validate the fourth step
    protected function validatestep4()
    {
        $this->validate([
            'grade_applied_for' => 'required|string|max:50',
            'previous_school_name' => 'nullable|string|max:255',
            'previous_grades' => 'nullable|string|max:255',
            'admission_date' => 'required|date',
        ]);
    }

    //validate the fifth step
    protected function validatestep5()
    {

        $this->validate([
            'academic_records' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'reports_cards' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'transfer_certificate' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'birth_certificate' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);
    }

    //function to fill in same as student info for the guardian 
    public function updatedSameAsStudent($value)
    {
        if ($value) {
            //copy the student info to guardian info
            $this->guardian_phone = $this->phone;
            $this->guardian_email = $this->email;

            //check to dump the values for testing
            dump($this->guardian_phone, $this->guardian_email);

        } else {
            //clear the guardian info fields
            $this->guardian_phone = '';
            $this->guardian_email = '';

            //check to dump the values for testing
            dump($this->guardian_phone, $this->guardian_email);
        }
    }


}
