<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentGraduationProjectController;
use App\Http\Controllers\DepartmentInternshipController;
use App\Http\Controllers\GraduationProjectController;
use App\Http\Controllers\InternshipCompanyController;
use App\Http\Controllers\InternshipCourseController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\SupervisorGraduationProjectController;
use App\Http\Controllers\SupervisorInternshipController;
use App\Http\Controllers\TimelineController;

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
######################### Student #########################
###########################################################


// Main Student Routes
Route::controller(StudentController::class)->name('student.')->group(function(){
    Route::get('/login', 'create')->name('login');
    Route::get('/', 'home')->name('home')->middleware('is.student');
})->middleware('auth');




// Internship Company Routes
Route::middleware(['auth','in.int'])->group(function(){
    Route::get('/company/edit', [InternshipCompanyController::class, 'edit'])->name('company.edit');
    Route::resource('company', InternshipCompanyController::class)->except(['index', 'show','edit']);
});



// Internship Course Routes
Route::resource('course', InternshipCourseController::class)->middleware(['auth','in.int'])
->except(['index', 'show', 'edit']);




// Graduation Project's Routes
Route::middleware(['auth','in.gp'])->group(function(){
    Route::get('/graduation-project/edit', [GraduationProjectController::class, 'edit'])->name('graduation-project.edit');
    Route::resource('graduation-project', GraduationProjectController::class)->except(['index', 'show', 'edit']);
});


// Timeline's Route
Route::get('graduation-project/timeline',[TimelineController::class, 'index'])->name('timeline')->middleware(['auth','in.gp']);


// Graduation Project Post's Routes
Route::middleware(['auth'])->group(function(){
    Route::resource('post', PostController::class)->except(['index', 'create', 'show']);
});


// Post's Comment Route
Route::post('/store/{post}', [CommentController::class, 'store'])->middleware(['auth'])->name('comment.store');
Route::resource('comment', CommentController::class)->only(['destroy'])->middleware(['auth']);





###########################################################
####################### Supervisor ########################
###########################################################


// Supervisor's Main Route
Route::controller(SupervisorController::class)->prefix('supervisor')->name('supervisor.')->group(function(){
    Route::get('/login', 'create')->name('login');
    Route::get('/', 'home')->name('home')->middleware('is.supervisor');
})->middleware('auth');



// Supervisor's Graduation Project Route
Route::controller(SupervisorGraduationProjectController::class)->prefix('supervisor')->name('supervisor.')->group(function(){
    Route::get('/graduation-project-teams', 'index')->name('teams');
    Route::get('/graduation-project-team-details', 'show')->name('show');
})->middleware(['auth','is.supervisor']);



// Supervisor's Internship Route
Route::controller(SupervisorInternshipController::class)->prefix('supervisor')->name('supervisor.')->group(function(){
    Route::get('/internship/student-list', 'index')->name('student-list');
    Route::get('/internship/report/{user}', 'show')->name('report');
    Route::post('/internship/report/store-course-note/{course}/{status}', 'storeCourseNote')->name('storeCourseNote');
    Route::post('/internship/report/store-company-note/{company}/{status}', 'storeCompanyNote')->name('storeCompanyNote');
})->middleware(['auth','is.supervisor']);








###########################################################
####################### Department ########################
###########################################################

// Department's Main Route
Route::controller(DepartmentController::class)->prefix('department')->name('department.')->group(function(){
    Route::get('/', 'home')->name('home');
    Route::get('/login', 'create')->name('login')->middleware('guest');
    Route::post('/store/{department}', 'store')->name('store');
})->middleware(['auth', 'is.head']);



// Department's Internship Route
Route::controller(DepartmentInternshipController::class)->prefix('department')->name('department.')->group(function(){
    Route::get('/in-internship-students', 'index')->name('in_int');
    Route::post('/store', 'store')->name('store_in_int');
    Route::get('/student-report/{student_rec}', 'show')->name('show');
})->middleware(['auth', 'is.head']);


// Department's Graduation Project Route
Route::controller(DepartmentGraduationProjectController::class)->prefix('department')->name('department.')->group(function(){
    Route::get('/Graduation-Project/exceed-90-hours', 'exceed90')->name('exceed90');
    Route::get('/Graduation-Project/teams', 'teams')->name('teams');
    Route::get('/Graduation-Project/team-details/{graduation_project}', 'team_details')->name('team-details');
});



// Route::get('/test/', function(){
//     return view('supervisor.Graduation-Project.teams');
// });


Route::fallback(fn() => view('404'));


