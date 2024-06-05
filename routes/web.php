<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GraduationProjectController;
use App\Http\Controllers\InternshipCompanyController;
use App\Http\Controllers\InternshipCourseController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\SupervisorGraduationProjectController;
use App\Http\Controllers\TimelineController;
use App\Models\GraduationProject;
use App\Models\Supervisor;
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
Route::middleware(['auth','in.gp'])->group(function(){
    Route::resource('post', PostController::class)->except(['index', 'create', 'show']);
});







###########################################################
####################### Supervisor ########################
###########################################################



Route::controller(SupervisorController::class)->prefix('supervisor')->name('supervisor.')->group(function(){
    Route::get('/login', 'create')->name('login');
    Route::get('/', 'home')->name('home')->middleware('is.supervisor');
})->middleware('auth');




Route::controller(SupervisorGraduationProjectController::class)->prefix('supervisor')->name('supervisor.')->group(function(){
    Route::get('/graduation-project-teams', 'index')->name('teams');
    Route::get('/graduation-project-team-details', 'show')->name('show');
})->middleware('is.supervisor');








###########################################################
####################### Department ########################
###########################################################



Route::controller(DepartmentController::class)->prefix('department')->name('department.')->group(function(){
    Route::get('/', 'home')->name('home');
    Route::get('/login', 'create')->name('login');
    Route::post('/store/{department}', 'store')->name('store');
})->middleware(['auth', 'is.head']);




// Route::get('/test/', function(){
//     return view('supervisor.Graduation-Project.teams');
// });


Route::fallback(fn() => view('404'));


