<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeeklyFormRequest;
use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use App\Models\WeeklyFollowing;
use Illuminate\Http\Request;

class WeeklyFollowingFormController extends Controller
{
    public function weeklyFollowing(String $username){
        return view('department.Internship.weekly-following');
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
}
