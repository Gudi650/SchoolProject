<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class LibraryInventory extends Controller
{
    //get the use details
    public function getUserDetails()
    {

        //authenticated user
        $user = auth()->id();

        //the libratinan details
        $librarian = Teacher::where('user_id', $user)
                        ->with('schools')
                        ->first();

        

    }
}


