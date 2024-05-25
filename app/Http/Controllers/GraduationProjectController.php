<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddGraduationProjectRequest;
use App\Models\Department;
use App\Models\GraduationProject;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Backtrace\Arguments\Reducers\StdClassArgumentReducer;

use function PHPUnit\Framework\isNull;

class GraduationProjectController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /**
         * Create new Graduation Project record.
         * ---------------------------------------
         * check if the authenticated user register in the gp course, if true, then redirect him to edit page.
         * otherwise return the create view.
         */



        $rejected = session('rejectedStudents', []);
        $gp = GraduationProject::find(Student::firstWhere('user_id', Auth::user()->id)->graduation_project_id);
        if($gp){
            return redirect()->route('graduation-project.edit');
        }
        else {
            $departments = Department::get(['id', 'name'])->all();
            $student_no = Department::find(Auth::user()->department_id)->no_team_member;
            return view('student.Graduation-Project.reg-gp', compact(['departments', 'student_no', 'rejected']));
        }
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(AddGraduationProjectRequest $request)
    {
        $gp_form = $request->validated();
        
        $acceptedStudents = [];
        $rejectedStudents = [];
        if (!$this->checkStudents($request, $acceptedStudents, $rejectedStudents)) {
            session(['rejectedStudents' => $rejectedStudents]);
            return redirect()->route('graduation-project.create');
        }
        
        
        
        session(['rejectedStudents' => $rejectedStudents]);
        $gpModel = GraduationProject::create($gp_form);
        foreach($acceptedStudents as $student){
            $student->graduation_project_id = $gpModel->id;
            $student->save();
        }



        return redirect()->route('graduation-project.edit')->with('GpFilledSuccessfully', 'The Form has been filled successfully.');
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GraduationProject $graduation_project)
    {
        $isInGp = Student::firstWhere('user_id', Auth::user()->id)->graduation_project_id;
        if(!$isInGp)
            return redirect()->route('graduation-project.create');


        $gp = GraduationProject::find($isInGp);
        $rejected = session('rejectedStudents', []);
        $departments = Department::get(['id', 'name'])->all();
        $student_no = Department::find(Auth::user()->department_id)->no_team_member;
        return view('student.Graduation-Project.edit-gp', compact(['departments', 'student_no', 'gp', 'rejected']));
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









    private function checkStudents($request, &$acceptedStudents, &$rejectedStudents)
    {
        $alreay = " already registered in other team.";
        $notStudent = " is not a student.";
        $lessThan90 = " isn't exceeds 90 hour.";




        // add the authenticated user
        $acceptedStudents = [Student::firstWhere('user_id', Auth::user()->id)];



        $stu_num = Department::find(Auth::user()->department_id)->no_team_member;
        $count = 0;
        for ($i=1; $i <= $stu_num; $i++) {


            if (count($acceptedStudents) == $stu_num) break;


            // check if is_null.
            if (is_null($request['name'.$i]) && is_null($request['stu_id'.$i]) && is_null($request['major'.$i])){
                $count++;
                continue;
            }



            try{
                $stu_user = User::firstWhere('university_id', $request['stu_id'.$i]);
                $isStudent = Student::firstWhere('user_id' , $stu_user->id);
                ($isStudent == null)? throw new  Exception: null;


                if($isStudent->in_graduation_project){
                    if ($isStudent->graduation_project_id){
                        array_push($rejectedStudents, "(".$request['name'.$i]." -- ".$request['stu_id'.$i].")" . $alreay);
                        $count++;
                    }
                    else {
                        if (Auth::user()->university_id == $request['stu_id'.$i]) continue;
                        array_push($acceptedStudents, $isStudent);
                    }
                }
                else {
                    array_push($rejectedStudents, "(".$request['name'.$i]." -- ".$request['stu_id'.$i].")" . $lessThan90);
                    $count++;
                }
            }
            catch(Exception $e){
                array_push($rejectedStudents, "(".$request['name'.$i]." -- ".$request['stu_id'.$i].")" . $notStudent);
                $count++;
            }
        }



        // dump($acceptedStudents);
        // dd($rejectedStudents);



        if($count == $stu_num || count($acceptedStudents) == 0)
            return false;
        return true;
    }




    private function checkSupervisor($request)
    {
        //
    }

}
