<?php

use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Department\DepartmentGraduationProjectController;
use App\Http\Controllers\Department\DepartmentInternshipController;

use App\Http\Controllers\NotificationController;

use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\GraduationProjectController;
use App\Http\Controllers\Student\InternshipCompanyController;
use App\Http\Controllers\Student\InternshipCourseController;

use App\Http\Controllers\Supervisor\SupervisorController;
use App\Http\Controllers\Supervisor\SupervisorGraduationProjectController;
use App\Http\Controllers\Supervisor\SupervisorInternshipController;






use App\Http\Controllers\Timeline\PostController;
use App\Http\Controllers\Timeline\CommentController;
use App\Http\Controllers\Timeline\TimelineController;

use App\Http\Controllers\WeeklyFollowingFormController;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__.'/auth.php';





###########################################################
########################## Login ##########################
###########################################################


Route::middleware('guest')->group(function(){
    Route::get('/login', [StudentController::class, 'create'])->name('student.login');
    Route::get('/supervisor/login', [SupervisorController::class, 'create'])->name('supervisor.login');
    Route::get('/department/login', [DepartmentController::class, 'create'])->name('department.login');
});



###########################################################
###################### Notification #######################
###########################################################

Route::controller(NotificationController::class)->middleware('auth')->name('notification.')->group(function(){
    Route::post('/notification/read-all', 'read_all')->name('read_all');
    Route::get('/notification/read-one/{notification}', 'read_one')->name('read_one');
});



###########################################################
######################### Student #########################
###########################################################


Route::middleware(['auth', 'is.student'])->name('student.')->group(function(){
    
    
    // Main Student Routes
    Route::controller(StudentController::class)->group(function(){
        Route::get('/', 'home')->name('home');
    });
    
    
    
    
    // Internship Company Routes
    Route::middleware(['in.int'])->group(function(){
        Route::get('/company/edit', [InternshipCompanyController::class, 'edit'])->name('company.edit');
        Route::resource('company', InternshipCompanyController::class)->except(['index', 'show','edit']);
    });
    
    
    
    // Internship Course Routes
    Route::resource('course', InternshipCourseController::class)->middleware(['in.int'])
    ->except(['index', 'show', 'edit']);
    
    
    
    // Graduation Project's Routes
    Route::middleware(['in.gp'])->group(function(){
        Route::get('/graduation-project/edit', [GraduationProjectController::class, 'edit'])->name('graduation-project.edit');
        Route::resource('graduation-project', GraduationProjectController::class)->except(['index', 'show', 'edit']);

        // Timeline's Route
        Route::get('graduation-project/timeline',[TimelineController::class, 'index'])->name('timeline');
    });


});


Route::middleware('auth')->group(function(){
    
    // Graduation Project Post's Routes
    Route::resource('post', PostController::class)->except(['index', 'create', 'show']);
    
    // Post's Comment Route
    Route::post('/store/{post}', [CommentController::class, 'store'])->name('comment.store');
    Route::resource('comment', CommentController::class)->only(['destroy']);
});





###########################################################
####################### Supervisor ########################
###########################################################


Route::middleware(['auth', 'is.supervisor'])->prefix('supervisor')->name('supervisor.')->group(function(){

    // Supervisor's Main Route
    Route::controller(SupervisorController::class)->group(function(){
        Route::get('/', 'home')->name('home');
    });
    
    
    
    // Supervisor's Graduation Project Route
    Route::controller(SupervisorGraduationProjectController::class)->group(function(){
        Route::get('/graduation-project-teams', 'index')->name('teams');
        Route::get('/graduation-project-team-details/{graduation_project}', 'show')->name('show');
    });
    
    
    
    // Supervisor's Internship Route
    Route::controller(SupervisorInternshipController::class)->group(function(){
        Route::get('/internship/student-list', 'index')->name('student-list');
        Route::get('/internship/report/{student}', 'show')->name('report');
        Route::post('/internship/report/store-course-note/{course}/{status}', 'storeCourseNote')->name('storeCourseNote');
        Route::post('/internship/report/store-company-note/{company}/{status}', 'storeCompanyNote')->name('storeCompanyNote');
    });
});






###########################################################
####################### Department ########################
###########################################################

Route::middleware(['auth', 'is.head'])->prefix('department')->name('department.')->group(function(){
    
    
    // Department's Main Route
    Route::controller(DepartmentController::class)->group(function(){
        Route::get('/', 'home')->name('home');
        Route::post('/store/{department}', 'store')->name('store');
    });
    
    
    
    // Department's Internship Route
    Route::controller(DepartmentInternshipController::class)->group(function(){
        Route::get('/in-internship-students', 'index')->name('in_int');
        Route::post('/store', 'store')->name('store_in_int');
        Route::get('/student-report/{student_rec}', 'show')->name('show');
    });
    
    
    
    // Department's Graduation Project Route
    Route::controller(DepartmentGraduationProjectController::class)->group(function(){
        Route::get('/Graduation-Project/exceed-90-hours', 'exceed90')->name('exceed90');
        Route::get('/Graduation-Project/teams', 'teams')->name('teams');
        Route::get('/Graduation-Project/team-details/{graduation_project}', 'team_details')->name('team-details');
    });
});




// Weekly Following Form
Route::controller(WeeklyFollowingFormController::class)->name('weekly.')->group(function(){
    Route::get('weekly-following-form/{username}', 'weeklyFollowing')->name('following-form');
    Route::post('weekly-following-form/store/', 'store')->name('store');
    Route::post('weekly-following/mail', 'mails')->name('mail');
});


###########################################################
####################### Error Page ########################
###########################################################


Route::fallback(fn() => view('404'))->name('404');

