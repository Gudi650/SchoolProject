<?php

namespace App\Livewire;

use App\Models\parentEnrolllment;
use App\Models\School;
use App\Models\studentEnrollDetails;
use App\Models\studentEnrollment as ModelsStudentEnrollment;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudentEnrollment extends Component
{
    //with uploads trait
    use WithFileUploads;

    //property for modal
    public $isPersonalOpen = false;
    public $isContactOpen = false;
    public $isGuardianOpen = false;
    public $isAcademicOpen = false;
    public $isDocumentOpen = true;
    public $isOpen = false;

    //property for steps
    public int $step = 1;

    //properties for student enrollment
    public $schools;
    public $student_enrollment_id;
    public $schoolname;

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
    public $guardian_gender;

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

    //function to open the modal
    function openModal($property)
    {

        if($property == 'isContactOpen')
        {
            $this->isContactOpen = true;
        }
        elseif($property == 'isGuardianOpen')
        {
            $this->isGuardianOpen = true;
        }
        elseif($property == 'isAcademicOpen')
        {
            $this->isAcademicOpen = true;
        }
        elseif($property == 'isPersonalOpen')
        {
            $this->isPersonalOpen = true;
        }
        elseif($property == 'isDocumentOpen')
        {
            $this->isDocumentOpen = true;
        }

    }

    //function to close the modal
    function closeModal($property)
    {

        if($property == 'isContactOpen')
        {
            $this->isContactOpen = false;
        }
        if($property == 'isGuardianOpen')
        {
            $this->isGuardianOpen = false;
        }
        elseif($property == 'isAcademicOpen')
        {
            $this->isAcademicOpen = false;
        }
        elseif($property == 'isPersonalOpen')
        {
            $this->isPersonalOpen = false;
        }
        elseif($property == 'isDocumentOpen')
        {
            $this->isDocumentOpen = false;
        }

    }

    //function to save the modal changes in step 6 (preview page)
    function saveModalChanges($property)
    {
        if($property == 'isContactOpen')
        {
            $this->isContactOpen = false;
        }
        if($property == 'isGuardianOpen')
        {
            $this->isGuardianOpen = false;
        }
        elseif($property == 'isAcademicOpen')
        {
            $this->isAcademicOpen = false;
        }
        elseif($property == 'isPersonalOpen')
        {
            $this->isPersonalOpen = false;
        }
        elseif($property == 'isDocumentOpen')
        {
            $this->isDocumentOpen = false;
        }
        
    }



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

            //get the school name
            $this->schoolname = $this->getSchoolNameById($this->school_id);

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

            //obtain the guardian gender
            if($this->relationship == 'father')
            {
                $this->guardian_gender = 'male';
            }
            elseif($this->relationship == 'mother')
            {
                $this->guardian_gender = 'female';
            }
            else
            {
                $this->guardian_gender = 'other';
            }

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

            //get the school name
            $this->schoolname = $this->getSchoolNameById($this->school_id);

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
        $id =  now()->format('Y') . random_int(1000, 9999);

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

    //function to obtain the school name by id
    function getSchoolNameById($school_id)
    {
        $school = School::where('id', $school_id)->first();
        return $school ? $school->name : null;
    }

    //function to submit the enrollment form
    public function submitEnrollment()
    {

        //try and catch block for final validation

        try{

            //final validation before submission
            $this->validatestep1();
            $this->validatestep2();
            $this->validatestep3();
            $this->validatestep4();
            $this->validatestep5();
        }catch(ValidationValidationException $e)
        {
            //handle the validation exception
            $this->addError('validation', 'Please correct the errors in the form before submission.');
            throw $e;
        }

        //try and catch block for database operations

        try{

            //create a parent student enrollment record
            $parentEnrollment = parentEnrolllment::UpdateOrcreate(
                [
                    'email' => $this->guardian_email,
                ],
                [
                    //guardian info
                    'fname' => $this->firstname,
                    'mname' => $this->middlename,
                    'lname' => $this->lastname,
                    'relationship' => $this->relationship,
                    'gender' => $this->guardian_gender,
                    'phone' => $this->guardian_phone,
                    'email' => $this->guardian_email,
                    'city' => $this->city,
                    'district' => $this->district,
                    'ward' => $this->ward,
                    'street' => $this->street,

                ]
            );

            //create  the student enrollment record
            $studentEnrollment = ModelsStudentEnrollment::UpdateOrcreate(
                [
                    'student_enrollment_id' => $this->student_enrollment_id,
                ],
                [
                    //personal info
                    'fname' => $this->fname,
                    'mname' => $this->mname,
                    'lname' => $this->lname,
                    'gender' => $this->gender,
                    'date_of_birth' => $this->dob,
                    'school_id' => $this->school_id,
                    'previous_school_name' => $this->previous_school_name,
                    'student_enrollment_id' => $this->student_enrollment_id,
                    'parent_enrollment_id' => $parentEnrollment->id,
                ]

            ); 

            //create the student enrollment details records
            studentEnrollDetails::UpdateOrcreate(
                [
                    'student_enrollment_id' => $this->student_enrollment_id,
                ],
                [
                    //academic info
                    'admission_date' => $this->admission_date,
                    'grade_applied_for' => $this->grade_applied_for,
                    'previous_school_name' => $this->previous_school_name,
                    'academic_records' => json_encode(array_map(fn($file) => $file->getClientOriginalName(), $this->academic_records)),
                    'transfer_certificate' => json_encode(array_map(fn($file) => $file->getClientOriginalName(), $this->transfer_certificate)),
                    'birth_certificate' => $this->birth_certificate ? $this->birth_certificate->getClientOriginalName() : null,
                    'reports_card' => json_encode(array_map(fn($file) => $file->getClientOriginalName(), $this->reports_cards)),
                ]
            );

        }catch(\Exception $e)
        {
            //handle any database exceptions
            $this->addError('database', 'An error occurred while submitting the enrollment. Please try again.');
            throw $e;
        }


        //redirect to the beginning with a thank you message
        return redirect()->to('studentenrollment.thanks')->with('success', 'Enrollment submitted successfully! Thank you.');

    }

}
