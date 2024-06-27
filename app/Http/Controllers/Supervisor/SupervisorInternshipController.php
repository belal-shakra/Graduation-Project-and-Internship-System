<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddInternshipNoteRequest;
use App\Models\InternshipCompany;
use App\Models\InternshipCourse;
use App\Models\Notification;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorInternshipController extends Controller
{
    public function index(){

        $students = User::whereHas('students', function($query){
            $supervisor = Supervisor::firstWhere('user_id', Auth::user()->id);
            $query->where('in_internship', 1)->where('supervisor_id', $supervisor->id);
        })->where('department_id', Auth::user()->department_id)->get();

        return view('supervisor.Internship.students-list', compact('students'));
    }



    public function show(User $user){

        if($user->department_id != Auth::user()->department_id ||
        !$user->students[0]->in_internship || $user->students[0]->supervisor->user_id != Auth::user()->id)
            return back();

        $student = $user;
        return view('supervisor.Internship.report', compact('student'));
    }


    public function storeCourseNote(AddInternshipNoteRequest $request, InternshipCourse $course, bool $status){
        $note = $request->validated();

        $course->supervisor_note = $note['supervisor_note'];
        $course->acceptance = $status;
        $course->save();

        if($status)
            $review = 'acceppt';
        else
            $review = 'reject';

        Notification::create([
            'title'   => 'Internhip - Courses',
            'message' => 'Your Supervisor '. $review .' your Internship course.',
            'type'    => 'student',
            'is_read' => false,
            'user_id' => $course->student->user->id,
        ]);


        return back();
    }


    public function storeCompanyNote(AddInternshipNoteRequest $request, InternshipCompany $company, bool $status){
        $note = $request->validated();

        $company->supervisor_note = $note['supervisor_note'];
        $company->acceptance = $status;
        $company->save();


        if($status)
            $review = 'acceppt';
        else
            $review = 'reject';


        Notification::create([
            'title'   => 'Internhip - Company',
            'message' => 'Your Supervisor '. $review .' your Company Internship.',
            'type'    => 'student',
            'is_read' => false,
            'user_id' => $company->student->user->id,
        ]);

        return back();
    }
}
