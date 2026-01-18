<?php

namespace App\Http\Controllers;

use App\Models\ClassFeeOptions;
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
        // Also fetch the current saved data for display
        $currentSchoolId = 1; // TODO: Use auth()->user()->school_id
        $feeOptions = FeeOptions::where('school_id', $currentSchoolId)->first();
        $classLinked = ClassFeeOptions::where('fee_options_id', $feeOptions?->id)->get() ?? collect();
        
        return view('AccountantPanel.fees.fee-settings', [
            'feeStructures' => $feeStructures,
            'customFeeStructures' => $customFeeStructures,
            'feeOptions' => $feeOptions,
            'classLinked' => $classLinked,
        ]);

    }

    //function to save the fee settings
    public function saveFeeSettings(Request $request)
    {
        // Get all form data (except the security token)
        $formData = $request->except('_token');

        // Build validation rules
        // We need to check that every field has a value of either "required" or "optional"
        $validationRules = [];
        
        foreach ($formData as $inputName => $inputValue) {
            // Each input must be present and must be either "required" or "optional"
            $validationRules[$inputName] = 'required|in:required,optional';
        }

        // Validate the form data
        $validator = Validator::make($request->all(), $validationRules);

        // If validation fails, send user back with error messages
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Save the settings to database
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

            // Find or create ONE fee_options record for this school
            $feeOptionRecord = FeeOptions::firstOrCreate(
                ['school_id' => $currentSchoolId],
                ['dynamic_attributes' => []]
            );

            // Get existing settings from database (or empty array if none)
            $currentAttributes = $feeOptionRecord->dynamic_attributes ?? [];

            // Make sure the sections exist
            if (!isset($currentAttributes['general_components'])) {
                $currentAttributes['general_components'] = [];
            }
            if (!isset($currentAttributes['class_settings'])) {
                $currentAttributes['class_settings'] = [];
            }

            // Keep track of which classes we've seen (so we can add them to pivot table)
            $classIdsToLink = [];

            // Loop through each setting and save it
            foreach ($validatedSettings as $settingName => $settingValue) {
                // Determine if this is a general or class-specific setting
                $isClassSpecific = (strpos($settingName, 'class_') === 0);

                if ($isClassSpecific) {
                    // ===== CLASS-SPECIFIC SETTING =====
                    // Example: "class_5_tuition_fee" or "class_5_custom_science_lab"
                    
                    // Break the name into parts
                    // "class_5_tuition_fee" becomes ["class", "5", "tuition_fee"]
                    $nameParts = explode('_', $settingName, 3);
                    
                    $classIdFromName = $nameParts[1];  // Gets "5"
                    $componentName = $nameParts[2];     // Gets "tuition_fee"

                    // Track this class so we can add it to pivot table later
                    if (!in_array($classIdFromName, $classIdsToLink)) {
                        $classIdsToLink[] = $classIdFromName;
                    }

                    // Create a section for this specific class if it doesn't exist
                    if (!isset($currentAttributes['class_settings'][$classIdFromName])) {
                        $currentAttributes['class_settings'][$classIdFromName] = [];
                    }

                    // Check if this is a core component or custom component
                    if (in_array($componentName, $coreComponentsList)) {
                        // It's a core component - store in class settings
                        $currentAttributes['class_settings'][$classIdFromName][$componentName] = $settingValue;
                    } else {
                        // It's a custom component
                        if (!isset($currentAttributes['class_settings'][$classIdFromName]['custom_components'])) {
                            $currentAttributes['class_settings'][$classIdFromName]['custom_components'] = [];
                        }
                        $currentAttributes['class_settings'][$classIdFromName]['custom_components'][$componentName] = $settingValue;
                    }

                } else {
                    // ===== GENERAL SETTING (applies to all classes) =====
                    // Example: "tuition_fee" or "transport_fee"
                    
                    // Store in general_components section
                    $currentAttributes['general_components'][$settingName] = $settingValue;
                    
                    // ALSO update the actual column if it's a core component
                    if (in_array($settingName, $coreComponentsList)) {
                        // Update the column value (store the setting: "required" or "optional")
                        $feeOptionRecord->$settingName = $settingValue;
                    }
                }
            }

            // Save the updated JSON attributes
            $feeOptionRecord->dynamic_attributes = $currentAttributes;
            
            // Save everything to database
            $feeOptionRecord->save();

            //  Link classes to this fee_options record in the pivot table
            // This creates the relationship between classes and fee options
            foreach ($classIdsToLink as $classId) {
                // Insert into class_fee_options pivot table if it doesn't already exist
                // This links this class to this fee_options record
                ClassFeeOptions::updateOrCreate(
                    [
                        'class_id' => $classId,
                        'fee_options_id' => $feeOptionRecord->id,
                    ],
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
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
