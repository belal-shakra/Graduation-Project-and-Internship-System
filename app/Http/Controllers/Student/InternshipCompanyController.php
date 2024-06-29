<?php

namespace App\Http\Controllers\Student;


use App\Models\User;
use App\Models\Student;
use App\Models\UserType;
use App\Models\Notification;
use App\Models\InternshipCompany;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateInternshipCompanyRequest;
use App\Http\Requests\UpdateInternshipCompanyRequest;




class InternshipCompanyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if(Auth::user()->student->internship_company){
            return to_route('student.company.edit');
        }
        else
            return view('student.Internship.company');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateInternshipCompanyRequest $request)
    {
        $form = $request->validated();
        $form['student_id'] = Student::firstWhere('user_id', Auth::user()->id)->id;
        $company = InternshipCompany::create($form);

        $this->send_notification($company, 'fill');

        return to_route('student.company.edit')->with('companyFormFilledSuccessfully', 'The Form has been filled successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('student.Internship.edit-company', ['company' => Auth::user()->student->internship_company]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(InternshipCompany $company, UpdateInternshipCompanyRequest $request)
    {
        if($company->student_id == Auth::user()->student->id){
            $updatedForm = $request->validated();
            $updatedForm['student_id'] = $company->student_id;

            $company->update($updatedForm);
            $company->save();
            return back()->with('updatedSuccessfully', 'The form has been updated successfully.');
        }

        $this->send_notification($company, 'update');

        return back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InternshipCompany $company)
    {
        if($company->student_id == Auth::user()->student->id){
            $company->delete();
            return to_route('company.create');
        }

        return back();
    }


    /**
     * Send notification to the supervisor and to the department.
     */
    private function send_notification($company, $msg){
        $student_name = $company->student->user->first_name .' '. $company->student->user->last;
        Notification::create([
            'title'   => 'Internship | Company',
            'message' => $student_name . ' '. $msg . ' the company internship form.',
            'type'    => 'supervisor',
            'is_read' => false,
            'route'   => route('supervisor.report', Auth::user()->student),
            'user_id' => $company->student->supervisor_id,
        ]);



        $user_type = UserType::firstWhere('name', 'supervisor&head')->id;
        $head_id = User::where('user_type_id', $user_type)->firstWhere('department_id', Auth::user()->department_id)->id;
        Notification::create([
            'title'   => 'Internship | Company',
            'message' => $student_name . ' '. $msg .' the company internship form.',
            'type'    => 'department',
            'is_read' => false,
            'route'   => route('department.show', Auth::user()->student),
            'user_id' => $head_id,
        ]);
    }
}
