<?php

use App\Http\Controllers\GraduationProjectController;
use App\Http\Controllers\InternshipCompanyController;
use App\Http\Controllers\InternshipCourseController;
use App\Http\Controllers\StudentController;
use App\Models\GraduationProject;
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


// Main Routes
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








Route::fallback(fn() => view('404'));


