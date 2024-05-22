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

use function PHPUnit\Framework\isNull;

class GraduationProjectController extends Controller
{

    private $acceptedStudents;
    private $rejectedStudents;




    public function __construct(){

        $this->acceptedStudents = [];
        $this->rejectedStudents = [];
    }




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



        $gp = GraduationProject::find(Student::firstWhere('user_id', Auth::user()->id)->graduation_project_id);
        if($gp){
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
        $gp = Student::firstWhere('user_id', Auth::user()->id);
        $gp->graduation_project_id = null;
        $gp->save();



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




    private function addStudents($request)
    {
        $alreay = " already registered in other team.";
        $notStudent = " is not a student.";
        $lessThan90 = " isn't exceeds 90 hour.";


        $stu_num = Department::find(Auth::user()->department_id)->no_team_member;
        $count = 0;
        for ($i=1; $i <= $stu_num; $i++) {

            // check if is_null.
            if (is_null($request['name'.$i]) && is_null($request['stu_id'.$i]) && is_null($request['major'.$i])){
                $count++;
                continue;
            }




            try{
                $stu_user_id = User::firstWhere('university_id', $request['stu_id'.$i])->id;
                $isStudent = Student::firstWhere('user_id' , $stu_user_id);
                ($isStudent == null)? throw new  Exception: null;


                if($isStudent->in_graduation_project){
                    if ($isStudent->graduation_project_id){
                        array_push($this->rejectedStudents, "(".$request['name'.$i]." -- ".$request['stu_id'.$i].")" . $alreay);
                        $count++;
                    }
                    else {
                        array_push($this->acceptedStudents, $isStudent);
                    }
                }
                else {
                    array_push($this->rejectedStudents, "(".$request['name'.$i]." -- ".$request['stu_id'.$i].")" . $lessThan90);
                    $count++;
                }
            }
            catch(Exception $e){
                array_push($this->rejectedStudents, "(".$request['name'.$i]." -- ".$request['stu_id'.$i].")" . $notStudent);
                $count++;
            }
        }



        if($count == $stu_num)
            return false;
        return true;
    }

    private function checkSupervisor($request)
    {
        
    }


}
