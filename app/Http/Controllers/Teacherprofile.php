<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class Teacherprofile extends Controller
{
    //show the profile page of the teacher panel
    public function showProfile()
    {
        //pass the teacher's data to the view
        $teacher = Teacher::where('user_id', auth()->id())->first();

        //pass the user to the view
        $user = auth()->user();

        return view('TeacherPanel.profile', ['teacher' => $teacher, 'user' => $user]);
    }

    //update the profile of the teacher
    public function updateProfile(Request $request)
    {

        //validate the incoming request data
        $validatedData = $request->validate([
            'email' => 'email|max:255',
            'phone' => 'string|max:15',
        ]);

        //get the teacher record
        $teacher = Teacher::where('user_id', auth()->id())->first();

        //update the teacher's profile
        //update the teacher's profile
        if ($teacher) {
            $updateData = [];

            //check if email or phone values are present before updating
            if (isset($validatedData['email'])) {
                $updateData['email'] = $validatedData['email'];
            }

            if (isset($validatedData['phone'])) {
                $updateData['phone'] = $validatedData['phone'];
            }

            if (!empty($updateData)) {
                $teacher->update($updateData);
            }
        }

        //redirect back with success message
        return redirect()->back()->with('success', 'Profile updated successfully.');


    }

}

