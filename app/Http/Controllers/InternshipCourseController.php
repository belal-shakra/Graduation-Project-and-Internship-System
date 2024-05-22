<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\InternshipCourse;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipCourseController extends Controller
{
    private static $student;
    private $user;




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = InternshipCourse::where('student_id', Student::firstWhere('user_id',Auth::user()->id)->id)->get();

        // dd($courses);
        return view('student.Internship.courses', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCourseRequest $request)
    {
        $course = $request->validated();
        $course['student_id'] = Student::firstWhere('user_id', Auth::user()->id)->id;

        if(isset($course['certificate']))
            $course['certificate'] = $this->image_proccessing($request->certificate);

        InternshipCourse::create($course);
        return back()->with('course_added', 'The course has been added successfully.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, InternshipCourse $course)
    {
        if($course->student_id == Student::firstWhere('user_id', Auth::user()->id)->id){
            $u_course = $request->validated();

            $updated_course['name'] = $u_course['u_name'];
            $updated_course['hour'] = $u_course['u_hour'];
            $updated_course['provider'] = $u_course['u_provider'];

            if($request->hasFile('u_certificate')){
                $updated_course['certificate'] = $this->image_proccessing($request->certificate);
            }

            $course->update($updated_course);
            $course->save();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InternshipCourse $course)
    {
        if($course->student_id == Student::firstWhere('user_id', Auth::user()->id)->id){
            $course->delete();
        }
        return back();
    }



    public function image_proccessing($image)
    {
        $student_id = Student::firstWhere('user_id', Auth::user()->id)->id;
        $new_name = time() .'-'. $image->getClientOriginalName();
        $image->storeAs('Internship/courses/'. $student_id, $new_name, 'public');
        return $new_name;
    }
}
