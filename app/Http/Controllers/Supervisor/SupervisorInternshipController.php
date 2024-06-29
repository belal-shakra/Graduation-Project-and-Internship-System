<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddInternshipNoteRequest;
use App\Models\InternshipCompany;
use App\Models\InternshipCourse;
use App\Models\Notification;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorInternshipController extends Controller
{
    public function index(){

        $students = Student::where('supervisor_id', Auth::user()->supervisor->id)->get();
        return view('supervisor.Internship.students-list', compact('students'));
    }



    public function show(Student $student){
        if ($student->supervisor_id != Auth::user()->supervisor->id)
            return to_route('supervisor.student-list');

        $student = $student;
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
            'route'   => route('student.course.create'),
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
            'route'   => route('student.company.create'),
            'user_id' => $company->student->user->id,
        ]);

        return back();
    }
}
