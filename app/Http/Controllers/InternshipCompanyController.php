<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInternshipCompanyRequest;
use App\Http\Requests\UpdateInternshipCompanyRequest;
use App\Models\InternshipCompany;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipCompanyController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $company = InternshipCompany::firstWhere('student_id', Student::firstWhere('user_id', Auth::user()->id)->id);
        if($company){
            return redirect('/company/edit')->withInput([$company]);
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

        return to_route('company.edit')->with('companyFormFilledSuccessfully', 'The Form has been filled successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $student = Student::firstWhere('user_id', Auth::user()->id);

        return view('student.Internship.edit-company', compact(['student']));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(InternshipCompany $company, UpdateInternshipCompanyRequest $request)
    {
        if($company->student_id == Student::firstWhere('user_id', Auth::user()->id)->id){
            $updatedForm = $request->validated();
            $updatedForm['student_id'] = $company->student_id;

            $company->update($updatedForm);
            $company->save();
            return back()->with('updatedSuccessfully', 'The form has been updated successfully.');
        }

        return back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InternshipCompany $company)
    {
        if($company->student_id == Student::firstWhere('user_id', Auth::user()->id)->id){
            InternshipCompany::destroy($company->id);
            return to_route('company.create');
        }

        return back();
    }
}
