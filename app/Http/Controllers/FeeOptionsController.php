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


        // Validate that every submitted field is either 'required' or 'optional'
        $input = $request->except(['_token']);

        // Build validation rules dynamically: every input must be present and one of the allowed values
        $rules = [];
        foreach (array_keys($input) as $key) {
            $rules[$key] = ['required', 'in:required,optional'];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
