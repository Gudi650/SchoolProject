<?php

use App\Http\Controllers\AssignClasses;
use App\Http\Controllers\AssignedSubjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateExamController;
use App\Http\Controllers\ParentregistrationController;
use App\Http\Controllers\PostExamResults;
use App\Http\Controllers\Student;
use App\Http\Controllers\Teacherprofile;
use App\Http\Controllers\TeacherregistrationController;
use App\Http\Controllers\TeacherRoleController;
use Illuminate\Support\Facades\Route;

//create middleware to the routes that require authentication
Route::middleware('auth')->group(function () {

    //routes for homepage student panel
    Route::get('/', [Student::class, 'index'])->name('student.homepage');

    Route::get('/student-panel/exams-results', function () {
        return view('StudentPanel.exams-results');
    })->name('student.exams');

    Route::view('/student-panel/timetable', 'StudentPanel.timetable')->name('student.timetable');

    Route::view('/student-panel/library', 'StudentPanel.library')->name('student.library');

    Route::view('/student-panel/feespayment', 'StudentPanel.feespayment')->name('student.feespayment');

    Route::view('/student-panel/announcements', 'StudentPanel.announcements')->name('student.announcements');

    Route::view('/student-panel/assignments', 'StudentPanel.assignment')->name('student.assignments');

    Route::view('/student-panel/attendance/checkin', 'StudentPanel.attendance.checkin')->name('student.attendance.checkin');

    Route::view('/student-panel/attendance/attendancereport', 'StudentPanel.attendance.attendancereport')->name('student.attendance.report');


    ///////////////////////////////////////////////////////////
    //for dashboard
    Route::get('/teacher-dashboard', function () {
        return view('TeacherPanel.dashboard');
    })->name('teacher.dashboard');

    //for announcements
    Route::get('/teacher-announcements', function () {
        return view('TeacherPanel.announcements');
    })->name('teacher.announcements');


///////////////////////////////////////////////


    //profile route using controller
    Route::get('/teacher-profile', [Teacherprofile::class, 'showProfile'])->name('teacher.profile');

    //update profile route
    Route::post('/teacher-profile', [Teacherprofile::class, 'updateProfile'])->name('teacher.updateprofile');


////////////////////////////////////////////

    //route to show the post exam page
    Route::get('/teacher-postresults', [PostExamResults::class , 'showPostExamPage'])->name('teacher.postresults');

    //route to handle the post exam results controller form submission
    Route::post('/teacher-postresults-controller', [PostExamResults::class , 'postExamController'])->name('teacher.postresultscontroller.submit');

    //route to handle the post exam results form submission
    Route::post('/teacher-postresults', [PostExamResults::class , 'postExamResults'])->name('teacher.postresults.submit');

    //route to handle the edit modal exam results form submission
    Route::post('/teacher-editexamresults', [PostExamResults::class , 'updateExamResult'])->name('teacher.editexamresults.submit');


//////////////////////////////////////////////////////////////////




    //for generate exam page
    Route::get('/teacher-generateresults', [GenerateExamController::class, 'generateExamPage'])->name('teacher.generateresults');


////////////////////////////////////////////////////////


    //for generate timetable
    Route::get('/teacher-generatetimetable', function () {
        return view('TeacherPanel.generatetimetable');
    })->name('teacher.generatetimetable');

    //for exam analysis
    Route::get('/teacher-examanalysis', function () {
        return view('TeacherPanel.examanalysis');
    })->name('teacher.examanalysis');

    //for view schedule
    Route::get('/teacher-schedule', function () {
        return view('TeacherPanel.schedule');
    })->name('teacher.schedule');

    //for exam timetable generation
    Route::get('/teacher-examtimetable', function () {
        return view('TeacherPanel.generateexamtimetable');
    })->name('teacher.generateexamtimetable');

    //////////////////////////////////////////////////////////// teacher role assignment routes

    //route to show available teacher roles using controller
    Route::get('/teacher-assignroles', [TeacherRoleController::class, 'showAssignRoles'])->name('teacher.assignroles');

    //handle submitted assigned roles form
    Route::post('/teacher-assignroles', [TeacherRoleController::class, 'assignTeacherRoles'])->name('teacher.assignroles.submit');

    ////////////////////////////////////////////////////////////// end of teacher role assignment routes


///////////////////////////////////////////////////////////////    



    //view assign subject route 
    Route::get('/teacher-assignsubjects', [AssignedSubjectController::class, 'showAssignedSubjects'])->name('teacher.assignsubjects');

    //assign subject to teachers route to handle form submission
    Route::post('/teacher-assignsubjects', [AssignedSubjectController::class, 'assignSubjectToTeacher'])->name('teacher.assignsubjects.submit');


/////////////////////////////////////////////////////////////

    //show assign classes
    Route::get('/teacher-assignclasses', [AssignClasses::class, 'showAssignClasses'])->name('teacher.assignclasses');

    //assign classes route to handle form submission
    Route::post('/teacher-assignclasses', [AssignClasses::class, 'assignClasses'])->name('teacher.assignclasses.submit');



/////////////////////////////////////////////////////////////end of teacher panel routes

    //routes to handle student and parent registrations submissions
    Route::post('/studentregistration', [ParentregistrationController::class, 'StudentRegistration'])->name('studentregistration');

    Route::post('/parentregistration', [ParentregistrationController::class, 'ParentRegistration'])->name('parentregistration');

    //logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});



//middleware for routes that do not require authentication
Route::middleware('guest')->controller(AuthController::class)->group(function(){

    //routes showing the login and signup forms
    Route::get('/login', 'showLogin')->name('showlogin');
    Route::get('/signup', 'showSignUp')->name('showsignup');

});


Route::get('/parentregistration',[ParentregistrationController::class , 'showParentRegistration'])->name('showparentregistration');

Route::get('/studentregistration',[ParentregistrationController::class , 'showStudentRegistration'])->name('showstudentregistration');


//routes handling login and signup form submissions
Route::post('/login', [AuthController::class , 'login'])->name('login');
Route::post('/signup', [AuthController::class , 'signup'])->name('signup');


//route to show teacher registration form
Route::get('teacher-registration',[TeacherregistrationController::class, 'showTeacherRegistration'])->name('showteacherregistration');

//route to handle teacher registration form submission
Route::post('teacher-registration',[TeacherregistrationController::class, 'register'])->name('teacherregistration');
