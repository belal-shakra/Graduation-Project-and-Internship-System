<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\InternshipCourse;
use App\Models\Notification;
use App\Models\Student;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipCourseController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student = Student::firstWhere('user_id',Auth::user()->id);

        return view('student.Internship.courses', compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCourseRequest $request)
    {
        $course = $request->validated();
        $course['student_id'] = Student::firstWhere('user_id', Auth::user()->id)->id;

        if(isset($course['certificate']))
            $course['certificate'] = $this->file_proccessing($request->certificate);

        $course = InternshipCourse::create($course);

        $this->send_notification($course, 'add');

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
                $updated_course['certificate'] = $this->file_proccessing($request->u_certificate);
            }

            $course->update($updated_course);
            $course->save();


            $this->send_notification($course, 'update');
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

        $this->send_notification($course, 'delete');
        return back();
    }



    private function file_proccessing($image)
    {
        $student_id = Student::firstWhere('user_id', Auth::user()->id)->id;
        $new_name = time() .'-'. $image->getClientOriginalName();
        $image->storeAs('Internship/courses/'. $student_id, $new_name, 'public');
        return $new_name;
    }


    private function send_notification($course, $msg){
        $student_name = $course->student->user->first_name .' '. $course->student->user->last;
        Notification::create([
            'title'   => 'Internship | Company',
            'message' => $student_name . ' '. $msg . ' a course of internship - courses.',
            'type'    => 'supervisor',
            'is_read' => false,
            'user_id' => $course->student->supervisor_id,
        ]);



        $user_type = UserType::firstWhere('name', 'supervisor&head')->id;
        $head_id = User::where('user_type_id', $user_type)->firstWhere('department_id', Auth::user()->department_id)->id;
        Notification::create([
            'title'   => 'Internship | Company',
            'message' => $student_name . ' '. $msg .' a course of internship - courses.',
            'type'    => 'department',
            'is_read' => false,
            'user_id' => $head_id,
        ]);
    }
}
