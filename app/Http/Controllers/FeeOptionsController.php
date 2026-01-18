<?php

namespace App\Http\Controllers;

use App\Models\FeeOptions;
use App\Models\FeeStructure;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeeOptionsController extends Controller
{
    //

    //view the fee settings page
    public function viewFeeSettings()
    {

        //get the details of the logged in user
        //$details = $this->getUserDetails();

        //get the fee structures of the school
        //$feeStructures = $this->getFeeStructures($details['school']->id);

        //get the custom fee structures for specific classes
        //$customFeeStructures = $this->getCustomFeeStructures($details['school']->id);

        /*
            THIS HAS TO BE CHANGED LATER TO DYNAMIC SCHOOL ID
            AS THIS IS NOT VALID LATER ON WHEN MULTI SCHOOL IS IMPLEMENTED

        */

        //temporarily require the data
        $feeStructures = $this->getFeeStructures(1); 
        $customFeeStructures = $this->getCustomFeeStructures(1);


        //return the fee settings view
        return view('AccountantPanel.fees.fee-settings', [
            'feeStructures' => $feeStructures,
            'customFeeStructures' => $customFeeStructures,
        ]);

    }

    //function to save the fee settings
    public function saveFeeSettings(Request $request)
    {
        // STEP 1: Get all form data (except the security token)
        $formData = $request->except('_token');

        // STEP 2: Build validation rules
        // We need to check that every field has a value of either "required" or "optional"
        $validationRules = [];
        
        foreach ($formData as $inputName => $inputValue) {
            // Each input must be present and must be either "required" or "optional"
            $validationRules[$inputName] = 'required|in:required,optional';
        }

        // STEP 3: Validate the form data
        $validator = Validator::make($request->all(), $validationRules);

        // If validation fails, send user back with error messages
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // STEP 4: Save the settings to database
        try {
            // Get the current school ID (hardcoded for now, will use auth later)
            $currentSchoolId = 1; // TODO: Change to auth()->user()->school_id
            
            // Get the validated data (all fields that passed validation)
            $validatedSettings = $validator->validated();

            // Define which fee components are core/standard (same for all schools)
            $coreComponentsList = [
                'tuition_fee',
                'transport_fee',
                'library_fee',
                'exam_fee',
                'hostel_fee'
            ];

            // STEP 5: Loop through each setting and save it
            foreach ($validatedSettings as $settingName => $settingValue) {
                // Convert "required"/"optional" text to true/false
                $isThisRequired = ($settingValue === 'required');

                // STEP 6: Determine if this is a general or class-specific setting
                // Check if the setting name starts with "class_"
                $isClassSpecific = (strpos($settingName, 'class_') === 0);

                if ($isClassSpecific) {
                    // ===== CLASS-SPECIFIC SETTING =====
                    // Example: "class_5_tuition_fee" or "class_5_custom_science_lab"
                    
                    // Break the name into parts
                    // "class_5_tuition_fee" becomes ["class", "5", "tuition_fee"]
                    $nameParts = explode('_', $settingName, 3);
                    
                    $classIdFromName = $nameParts[1];  // Gets "5"
                    $componentName = $nameParts[2];     // Gets "tuition_fee"

                    // Find existing fee option for this class, or create a new one
                    $feeOptionRecord = FeeOptions::firstOrCreate(
                        // Search conditions: find by school and class
                        [
                            'school_id' => $currentSchoolId,
                            'class_id' => $classIdFromName,
                        ],
                        // If not found, create with these default values
                        [
                            'currency' => 'TSH',
                            'tuition_fee' => 0,
                        ]
                    );

                    // Get existing settings from database (or empty array if none)
                    $currentAttributes = $feeOptionRecord->dynamic_attributes ?? [];

                    // Check if this is a core component or custom component
                    if (in_array($componentName, $coreComponentsList)) {
                        // It's a core component (tuition, transport, etc.)
                        // Store it in the "components" section
                        $currentAttributes['components'][$componentName] = $settingValue;
                    } else {
                        // It's a custom component (school added this themselves)
                        // Make sure the custom_components section exists
                        if (!isset($currentAttributes['custom_components'])) {
                            $currentAttributes['custom_components'] = [];
                        }
                        // Store it in the "custom_components" section
                        $currentAttributes['custom_components'][$componentName] = $settingValue;
                    }

                    // Save the updated settings back to database
                    $feeOptionRecord->dynamic_attributes = $currentAttributes;
                    $feeOptionRecord->save();

                } else {
                    // ===== GENERAL SETTING (applies to all classes) =====
                    // Example: "tuition_fee" or "transport_fee"
                    
                    // Find existing general fee option, or create a new one
                    // class_id = NULL means it applies to all classes
                    $generalFeeOption = FeeOptions::firstOrCreate(
                        // Search conditions
                        [
                            'school_id' => $currentSchoolId,
                            'class_id' => null,  // NULL = general setting
                        ],
                        // Default values if creating new record
                        [
                            'currency' => 'TSH',
                            'tuition_fee' => 0,
                        ]
                    );

                    // Get existing settings
                    $generalAttributes = $generalFeeOption->dynamic_attributes ?? [];
                    
                    // Store this component's setting
                    $generalAttributes['components'][$settingName] = $settingValue;
                    
                    // Save back to database
                    $generalFeeOption->dynamic_attributes = $generalAttributes;
                    $generalFeeOption->save();
                }
            }

            // Success! Redirect back with success message
            return redirect()->back()->with('success', 'Fee settings saved successfully!');

        } catch (\Exception $error) {
            // Something went wrong - show error to user
            return redirect()->back()->with('error', 'Error saving settings: ' . $error->getMessage());
        }
    }



    //obtain the personal and school details of the logged in user
    protected function getUserDetails()
    {
        //get the user id 
        $userId = auth()->id();

        //get the teacher of the user
        $teacher = Teacher::where('user_id', $userId)->first();

        //get teh school of teh teacher
        $school = $teacher->schools;

        //get the classes of the school
        $classes = $school->classAvailables;


        return [
            'userId' => $userId,
            'teacher' => $teacher,
            'school' => $school,
            'classes' => $classes,
        ];

    }

    //get the fee structures of a school
    protected function getFeeStructures($schoolId)
    {

        //get the fee structures of the school
        $feeStructures = FeeStructure::where('school_id', $schoolId)
                            ->where('for', 'general')
                            ->get();

        //return the fee structures
        return $feeStructures;

    }

    //get the fee structures for specific classes
    protected function getCustomFeeStructures($schoolId)
    {

        //get the fee structures of the school with related classes
        $customFeeStructures = FeeStructure::where('school_id', $schoolId)
                            ->where('for', 'specific')
                            ->with('classes')
                            ->get();

        //return the fee structures
        return $customFeeStructures;

    }


}
