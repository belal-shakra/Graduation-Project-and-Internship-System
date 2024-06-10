<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeeklyFormRequest;
use App\Mail\WeeklyFollowingMail;
use App\Models\Department;
use App\Models\InternshipCompany;
use App\Models\Notification;
use App\Models\Student;
use App\Models\User;
use App\Models\WeeklyFollowing;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class WeeklyFollowingFormController extends Controller
{
    private $weeks;


    public function __construct()
    {
        $this->weeks = ['First', 'Second', 'Third', 'Fourth', 'Fifth', 'Sixth'];
    }


    public function weeklyFollowing($username){
        $user = User::firstWhere('username', $username);

        try {
            $student = Student::where('in_internship', 1)->firstWhere('user_id', $user->id);
            $week = $student->user->department->week;
            $week = $this->weeks[$week-1];
        }
        catch (\Throwable $th) {
            return abort(404);
        }


        return view('department.Internship.weekly-following', compact(['student', 'week']));
    }



    public function store(WeeklyFormRequest $request){
        $form = $request->validated();

        $user = User::firstWhere('username', $form['student']);
        $student_id = Student::firstWhere('user_id', $user->id)->id;
        $form['student_id'] = $student_id;
        $form['week'] = $user->department->week;

        WeeklyFollowing::create($form);

        return back()->with('filledSuccessfully', 'The form submited Successfully');
    }



    public function mails(){

        $internships = InternshipCompany::whereHas('student', function($query){
            $query->whereHas('user', function($query){
                $query->where('department_id', Auth::user()->department_id);
            });
        })->get();

        $week = Auth::user()->department->week;

        foreach($internships as $internship){
            $details = [
                'supervisor' => $internship->supervisor_name,
                'student' => $internship->student->user->first_name. " " .$internship->student->user->last_name,
                'student_username' => $internship->student->user->username,
                'company_name' => $internship->company_name,
                'week' => $this->weeks[$week-1],
            ];

            $this->send($internship->supervisor_email, $details);



            Notification::create([
                'title'   => 'Weekly Following Form',
                'message' => 'The form for '.$this->weeks[$week-1].' week was sent.',
                'type'    => 'student',
                'is_read' => false,
                'user_id' => $internship->student->user->id,
            ]);
        }

        $department = Department::find(Auth::user()->department_id);
        $department->week += 1;
        $department->save();

        return back();
    }



    public function send($email, $details){
        Mail::to($email)->send(new WeeklyFollowingMail($details));
    }
}
