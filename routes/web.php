<?php

use App\Http\Controllers\AssignClasses;
use App\Http\Controllers\AssignedSubjectController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneratedTimetableController;
use App\Http\Controllers\GenerateExamController;
use App\Http\Controllers\ParentregistrationController;
use App\Http\Controllers\PostExamResults;
use App\Http\Controllers\Student;
use App\Http\Controllers\StudentApplicants;
use App\Http\Controllers\StudentAttendanceReport;
use App\Http\Controllers\studentEnrollment;
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


/////////////////////////////////////////////////////////////////
///routes for student enrollment

//route to show student enrollment settings
Route::get('/teacher-studentenrollment',function(){
    return view('TeacherPanel.studentenrollment.enrollmentSettings');
})->name('teacher.studentenrollment.settings');


//////////////////////////////////////////////////////////////////////////////////
///view the applicants page using contoller
Route::get('/teacher-studentapplicants', 
[StudentApplicants::class,'ViewStudentApplicants'])
->name('teacher.studentenrollment.applicants');

//reject applicant route using controller pass the id of the applicant as well
Route::post('/teacher-rejectapplicant/{id}',
[StudentApplicants::class,'RejectApplicant'])
->name('teacher.studentenrollment.rejectapplicant');

//approve applicant route using controller pass the id of the applicant as well
Route::post('/teacher-approveapplicant/{id}',
[StudentApplicants::class,'ApproveApplicant'])
->name('teacher.studentenrollment.approveapplicant');

// AJAX route to get applicants counts (pending, approved, rejected)
Route::get('/teacher-studentenrollment-counts',
[StudentApplicants::class,'GetApplicantsCounts'])
->name('teacher.studentenrollment.counts');


// Serve PDFs directly with proper headers (bypasses storage.local route issues)
// Added headers to prevent browser extensions like IDM from intercepting
Route::get('/serve-pdf/{path}', function($path) {
    $fullPath = storage_path('app/public/' . base64_decode($path));
    
    if (!file_exists($fullPath) || !is_file($fullPath)) {
        abort(404, 'PDF file not found');
    }
    
    return response()->file($fullPath, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="document.pdf"',
        'X-Content-Type-Options' => 'nosniff',
        'Cache-Control' => 'public, max-age=3600',
    ]);
})->where('path', '.*')->name('serve.pdf');


//route for analytics 
Route::get('/teacher-studentenrollment-analytics',function(){
    return view('TeacherPanel.studentenrollment.analytics');
})->name('teacher.studentenrollment.analytics');





//////////////////////////////////////////////////


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
    Route::get('/teacher-generateresults', 
    [GenerateExamController::class, 'generateExamPage'])
    ->name('teacher.generateresults');

    //Route for search exam results before the generation of results
    Route::post('/teacher-searchexamresults', [GenerateExamController::class, 'searchExamResults'])
    ->name('teacher.searchexamresults');

    // Save generated summaries (POST)
    Route::post('teacher-savegeneratedresults', [GenerateExamController::class, 'saveGeneratedResults'])
    ->name('teacher.savegeneratedresults');
    


////////////////////////////////////////////////////////
//////generate timetable routes



    Route::get('/teacher-generatedtimetable', [GeneratedTimetableController::class, 'viewGeneratedTimetable'])
    ->name('teacher.generatedtimetable.view');

    //route to handle input 
    Route::post('/teacher-timetableconditions', [GeneratedTimetableController::class, 'generateTimetable'])
    ->name('teacher.timetableconditions.submit');



////////////////////////////////////////////////////////////////////////

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


    ///////////////////////////////////////////////////////////
    //////register student attendances routes


    //for registering students attendance view route using controller
    Route::get('/teacher-registerstudentattendance', [AttendanceController::class, 'registerStudentAttendance'])->name('teacher.registerstudentattendance.view');

    //handling all student present attendance 
    Route::post('/teacher-registerstudentattendance', [AttendanceController::class, 'markAllPresent'])->name('registerstudentattendance.allpresent');

    //handling all student present except selected students
    Route::post('/teacher-registerstudentattendance-exceptabsent', [AttendanceController::class, 'markPresentExceptAbsent'])->name('registerstudentattendance.presentexceptabsent');


    /////////////////////////////////////////////////////////// end of register student attendance routes

    //////////////////////////////////////////////////////////////////// 
    ////show student attendance report route
    
    //view the student Attendance report using controller
    Route::get('/teacher-studentattendancereport', [StudentAttendanceReport::class, 'ViewStudentAttendance'])
    ->name('studentattendancereport');




    //////////////////////////////////////////////////////////// 
    ///////////teacher role assignment routes

    //route to show available teacher roles using controller
    Route::get('/teacher-assignroles', [TeacherRoleController::class, 'showAssignRoles'])->name('teacher.assignroles');

    //handle submitted assigned roles form
    Route::post('/teacher-assignroles', [TeacherRoleController::class, 'assignTeacherRoles'])->name('teacher.assignroles.submit');

    ////////////////////////////////////////////////////////////// end of teacher role assignment routes


///////////////////////////////////////////////////////////////    
//////assign subject to teachers routes


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



//route for testing purposes

//////////////////////////////////////////////////////////////////////
//route for accounting

//route for dashboard
Route::get('/accounting-dashboard', function () {
    return view('AccountantPanel.dashboard');
})->name('accounting.dashboard');

//route for fee management
Route::get('/fee-management', function () {
    return view('AccountantPanel.feeManagement');
})->name('accounting.feeManagement');

//route for income management
Route::get('/income-management', function () {
    return view('AccountantPanel.income');
})->name('accounting.incomeManagement');

//route for expenses management
Route::get('/expenses-management', function () {
    return view('AccountantPanel.expenses');
})->name('accounting.expensesManagement');


//route for payroll management
Route::get('/payroll-management', function () {
    return view('AccountantPanel.payroll');
})->name('accounting.payrollManagement');

//route for banking and cash management
Route::get('/banking-cash-management', function () {
    return view('AccountantPanel.bankingCash');
})->name('accounting.bankingCashManagement');

//route for vendors management
Route::get('/vendors-management', function () {
    return view('AccountantPanel.vendors');
})->name('accounting.vendorsManagement');

//route for budgeting management
Route::get('/budgeting-management', function () {
    return view('AccountantPanel.budget');
})->name('accounting.budgetingManagement');

//route for reports management
Route::get('/reports-management', function () {
    return view('AccountantPanel.report');
})->name('accounting.reportsManagement');

//route for invoice management
Route::get('/invoice-management', function () {
    return view('AccountantPanel.invoicing');
})->name('accounting.invoiceManagement');

//route for settings 
Route::get('/accounting-settings', function () {
    return view('AccountantPanel.settings');
})->name('accounting.settings');

///////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////
//route for studentEnrollment

//route for student enrollment 
Route::get('/student-enrollment', 
[studentEnrollment::class, 'viewStudentEnrollment'])
->name('studentenrollment.form');

//route for thanks page after submission
Route::get('/student-enrollment/thanks', function(){
    return view('studentenrollmentThank');
})->name('studentenrollment.thanks');
