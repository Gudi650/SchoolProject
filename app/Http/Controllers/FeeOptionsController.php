<?php

namespace App\Http\Controllers;

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


        // Get all the form data except the CSRF token
        $input = $request->except('_token');

        // Create an empty array to hold our rules
        $rules = [];

        // Go through each field in the form
        foreach ($input as $fieldName => $value) {
            // For each field, say:
            // 1. It must be present (required)
            // 2. Its value must be either "required" or "optional"
            $rules[$fieldName] = 'required|in:required,optional';
        }

        // Now validate the request using the rules we built
        $validator = Validator::make($request->all(), $rules);

        // Dump the validated data so the developer can observe it in the browser.
        dd($validator->validated());

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
