<?php

namespace App\Http\Controllers;

use App\Models\School;

class studentEnrollment extends Controller
{
    public function viewStudentEnrollment()
    {
        return view('studentEnrollment', ['schools' => School::all()]);
    }
}
