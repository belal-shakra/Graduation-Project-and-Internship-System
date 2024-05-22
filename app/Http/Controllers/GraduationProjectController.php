<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddGraduationProjectRequest;
use App\Models\Department;
use App\Models\GraduationProject;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraduationProjectController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gp = GraduationProject::find(Student::firstWhere('user_id', Auth::user()->id)->graduation_project_id);
        if(!$gp){
            return redirect()->route('graduation-project.edit', $gp);
        }
        else {
            $departments = Department::get(['id', 'name'])->all();
            $student_no = Department::find(Auth::user()->department_id)->no_team_member;
            return view('student.Graduation-Project.reg-gp', compact(['departments', 'student_no']));
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddGraduationProjectRequest $request)
    {
        $gp_form = $request->validated();
        GraduationProject::create($gp_form);






        $student_rec = Student::firstWhere('user_id', Auth::user()->id);
        $student_rec->graduation_project_id = GraduationProject::firstWhere('name', $gp_form['name'])->id;
        $student_rec->save();

        return back()->with('GpFilledSuccessfully', 'The Form has been filled successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GraduationProject $graduation_project)
    {
        $departments = Department::get(['id', 'name'])->all();

        $student_no = Department::find(Auth::user()->department_id)->no_team_member;
        return view('student.Graduation-Project.edit-gp', compact(['departments', 'student_no']));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GraduationProject $graduation_project)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GraduationProject $graduation_project)
    {
        //
    }
}
