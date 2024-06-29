<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Student;
use App\Models\UserType;
use App\Models\Notification;
use App\Models\InternshipCourse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class InternshipCourseController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.Internship.courses', ['student' => Auth::user()->student]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCourseRequest $request)
    {
        $course = $request->validated();
        $course['student_id'] = Auth::user()->student->id;

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
        if($course->student_id != Auth::user()->student->id)
            return back();


        
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

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InternshipCourse $course)
    {
        if($course->student_id == Auth::user()->student->id){
            $course->delete();
        }

        $this->send_notification($course, 'delete');
        return back();
    }


    /**
     * Get the uploaded file, change its name and store it.
     */
    private function file_proccessing($image)
    {
        $new_name = time() .'-'. $image->getClientOriginalName();
        $image->storeAs('Internship/courses/'. Auth::user()->student->id, $new_name, 'public');
        return $new_name;
    }


    /**
     * Send notification to the supervisor and to the department.
     */
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
