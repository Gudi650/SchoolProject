<?php

namespace App\Livewire;

use App\Models\studentEnrollment as ModelsStudentEnrollment;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudentEnrollment extends Component
{
    //with uploads trait
    use WithFileUploads;

    public int $step = 1;
    public $schools;
    public $student_enrollment_id;

    //step 1: Personal Information
    public $fname;
    public $mname;
    public $lname;
    public $dob;
    public $gender;
    public $school_id;
    public $student_profile_picture;

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
    public $academic_records = [];
    public $reports_cards =[];
    public $transfer_certificate = [];
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

    //function to cancel the uploads
    public function removefileUpload($property,$index)
    {
        unset($this->$property[$index]);

        //reindex the array to maintain proper indices
        $this->$property = array_values($this->$property);
    }

    //function to cancel a single file upload
    public function removeSingleFileUpload($property)
    {
        $this->$property = null;
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
            'student_profile_picture' => 'nullable|image|max:2048',
            ]);

            //save the profile picture if uploaded
            if($this->student_profile_picture){
                $path = $this->student_profile_picture->store('student_profiles', 'public');
            }

            //create a unique student enrollment id
            $this->generateNewEnrollmentId();

        }catch(ValidationValidationException $e)
        {
            //handle the validation exception
            $this->addError('validation', 'Please correct the errors in the form.');
            throw $e;
        }

    }

    //validate the second step
    protected function validatestep2()
    {

        try
        {
            $this->validate([
            'ward' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'street' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^\+?[0-9]{7,15}$/'],
            'email' => 'required|email|max:255',
            ]);
        }catch(ValidationValidationException $e)
        {
            //handle the validation exception
            $this->addError('validation', 'Please correct the errors in the form.');
            throw $e;
        }
        
    }

    //validate the third step
    protected function validatestep3()
    {
        try{

            $this->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'guardian_phone' => ['required', 'regex:/^\+?[0-9]{7,15}$/'],
            'guardian_email' => 'required|email|max:255',
            'relationship' => 'required|string|max:100',
            ]);

        }catch(ValidationValidationException $e)
        {
            //handle the validation exception
            $this->addError('validation', 'Please correct the errors in the form.');
            throw $e;
        }

    }

    //validate the fourth step
    protected function validatestep4()
    {
        try{

            $this->validate([
            'grade_applied_for' => 'required|string|max:50',
            'previous_school_name' => 'nullable|string|max:255',
            'previous_grades' => 'nullable|string|max:255',
            'admission_date' => 'nullable|date',
            ]);
        }catch(ValidationValidationException $e)
        {
            //handle the validation exception
            $this->addError('validation', 'Please correct the errors in the form.');
            throw $e;
        }

    }

    //validate the fifth step
    protected function validatestep5()
    {
        try{

            $this->validate([
                'academic_records' => 'required|array',
                'academic_records.*' => 'required|file|mimes:pdf,jpg,png|max:5120',
                'reports_cards' => 'nullable|array',
                'reports_cards.*' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
                'transfer_certificate' => 'nullable|array',
                'transfer_certificate.*' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
                'birth_certificate' => 'required|file|mimes:pdf,jpg,png|max:5120',
            ]);

            //handle file uploads here
            if ($this->academic_records) {
                foreach ($this->academic_records as $record) {
                    $record->store('documents/academic_records', 'public');
                }
            }
            if ($this->reports_cards) {
                foreach ($this->reports_cards as $record) {
                    $record->store('documents/reports_cards', 'public');
                }
            }
            if ($this->transfer_certificate) {
                foreach ($this->transfer_certificate as $record) {
                    $record->store('documents/transfer_certificates', 'public');
                }
            }
            if ($this->birth_certificate) {
                    $record->store('documents/birth_certificates', 'public');
            }
        }catch(ValidationValidationException $e)
        {
            //handle the validation exception
            $this->addError('validation', 'Please correct the errors in the form.');
            throw $e;
        }

    }

    //function to fill in same as student info for the guardian 
    public function updatedSameAsStudent($value)
    {
        if ($value) {
            //copy the student info to guardian info
            $this->guardian_phone = $this->phone;
            $this->guardian_email = $this->email;

        } else {
            //clear the guardian info fields
            $this->guardian_phone = '';
            $this->guardian_email = '';

        }
    }

    //function to generate a new student enrollment id
    public function generateNewEnrollmentId()
    {
        // Generate ID with prefix + year + random 4 digits
        $id = 'SE' . now()->format('Y') . random_int(1000, 9999);

        // Check if it exists in the database
        $exists = ModelsStudentEnrollment::where('student_enrollment_id', $id)->exists();

        if ($exists) {
            // If it exists, call the function again until unique
            return $this->generateNewEnrollmentId();
        }

        // If unique, assign and return
        $this->student_enrollment_id = $id;
        return $this->student_enrollment_id;
    }

}
