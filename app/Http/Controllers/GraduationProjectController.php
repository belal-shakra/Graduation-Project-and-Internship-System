<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddGraduationProjectRequest;
use App\Http\Requests\UpdateGraduationProjectRequest;
use App\Models\Department;
use App\Models\GraduationProject;
use App\Models\Student;
use App\Models\Supervisor;
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



        $gp = GraduationProject::find(Student::firstWhere('user_id', Auth::user()->id)->graduation_project_id);
        if($gp){
            return redirect()->route('graduation-project.edit');
        }
        else {
            $rejectedStudents = session('rejectedStudents', []);
            $rejectedSupervisors = session('rejectedSupervisors', []);
            $student_no = Department::find(Auth::user()->department_id)->no_team_member;
            return view('student.Graduation-Project.reg-gp', compact(['student_no', 'rejectedStudents', 'rejectedSupervisors']));
        }
    }




    /**f
     * Store a newly created resource in storage.
     */
    public function store(AddGraduationProjectRequest $request)
    {
        $gp_form = $request->validated();
        // dd($gp_form);
        
        $acceptedStudents = [];
        if(!$this->checkUser($request)){
            return redirect()->route("graduation-project.create");
        }
        
        $gpModel = GraduationProject::create($gp_form);
        
        $this->addStudents($gpModel);
        $this->addSupervisors($gpModel, $gp_form);



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
        $acceptedStudents = session('acceptedStudents', []);
        $rejectedStudents = session('rejectedStudents', []);
        $rejectedSupervisors = session('rejectedSupervisors', []);


        $student_no = Department::find(Auth::user()->department_id)->no_team_member;
        return view('student.Graduation-Project.edit-gp', compact(['student_no', 'gp', 'rejectedStudents', 'rejectedSupervisors', 'acceptedStudents']));
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGraduationProjectRequest $request, GraduationProject $graduation_project)
    {
        $updatedForm = $request->validated();


        // $acceptedStudents = [];
        // $this->removeStudents($graduation_project);
        if(!$this->checkUser($request)){
            return redirect()->route("graduation-project.edit");
        }


        $graduation_project->update($updatedForm);
        $this->addStudents($graduation_project);
        $this->addSupervisors($graduation_project, $updatedForm);

        return redirect()->route('graduation-project.edit')->with('GpUpdateSuccessfully', 'The Form has been updated successfully.');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GraduationProject $graduation_project)
    {
        //
    }





    private function checkUser($request){


        $acceptedStudents = [];
        $rejectedStudents = [];
        $rejectedSupervisors = [];

        $flag = true;
        if (!$this->checkStudents($request, $acceptedStudents, $rejectedStudents)){
            session(['rejectedStudents' => $rejectedStudents]);
            $flag = false;
        }
        session(['acceptedStudents' => $acceptedStudents]);

        if(!$this->checkSupervisor($request, $rejectedSupervisors)){
            session(['rejectedSupervisors' => $rejectedSupervisors]);
            $flag = false;
        }


        if($flag)
            return true;
        return false;
    }




    private function checkStudents($request, &$acceptedStudents, &$rejectedStudents)
    {
        $alreay = " already registered in other team.";
        $notStudent = " is not a student.";
        $isNotInGp = " isn't registered in graduation project.";
        $wrongDepartment = " isn't from ". Auth::user()->department->name . " department.";




        // add the authenticated user
        $acceptedStudents = [Student::firstWhere('user_id', Auth::user()->id)];



        $stu_num = Department::find(Auth::user()->department_id)->no_team_member;
        $count = 0;
        for ($i=1; $i <= $stu_num; $i++) {


            if (count($acceptedStudents) == $stu_num) break;
            if (Auth::user()->university_id == $request['stu_id'.$i]) continue;


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

                    if($stu_user->department->name != Auth::user()->department->name){
                        array_push($rejectedStudents, "(".$request['name'.$i]." -- ".$request['stu_id'.$i].")" . $wrongDepartment);
                        $count++;
                        continue;
                    }

                    if ($isStudent->graduation_project_id ){
                        array_push($rejectedStudents, "(".$request['name'.$i]." -- ".$request['stu_id'.$i].")" . $alreay);
                        $count++;
                    }
                    else {
                        array_push($acceptedStudents, $isStudent);
                    }
                }
                else {
                    array_push($rejectedStudents, "(".$request['name'.$i]." -- ".$request['stu_id'.$i].")" . $isNotInGp);
                    $count++;
                }
            }
            catch(Exception $e){
                array_push($rejectedStudents, "(".$request['name'.$i]." -- ".$request['stu_id'.$i].")" . $notStudent);
                $count++;
            }
        }


        if($count == $stu_num || count($acceptedStudents) == 1) // does the $acceptedStudent count can be 0?
            return false;
        return true;
    }




    private function checkSupervisor($request, &$rejectedSupervisors)
    {
        $isNotSupervisor = "is not a supervisor.";
        $notSameDept = "is not from " . Auth::user()->department->name . " department.";


        // dd("out the loop");
        for ($i=1; $i <= 2; $i++) { 
            $isUser = User::firstWhere("email", $request['email_'.$i]);
            
            if($isUser == null){
                array_push($rejectedSupervisors, "(".$request['supervisor_'.$i].
                " -- ".$request['email_'.$i] .") " . $isNotSupervisor);
                continue;
            }
            $isSupervisor = Supervisor::firstWhere("user_id", $isUser->id);


            if($isUser == null || $isSupervisor == null){
                array_push($rejectedSupervisors, "(".$request['supervisor_'.$i] ." ". " $isUser->last_name ".
                " -- ".$request['email_'.$i] .") " . $$isNotSupervisor);
                continue;
            }


            if($isUser->department->name != Auth::user()->department->name){
                array_push($rejectedSupervisors, "(".$isUser->first_name ." ". " $isUser->last_name ".
                " -- ".$isUser->email .") " . $notSameDept);
                continue;
            }
        }


        if(count($rejectedSupervisors))
            return false;
        return true;
    }




    private function addStudents($project) {
        $acceptedStudents = session('acceptedStudents', []);
        $this->removeStudents($project);

        foreach($acceptedStudents as $student){
            $student->graduation_project_id = $project->id;
            $student->save();
        }
    }

    private function addSupervisors($project, $project_form){
        $this->removeSupervisor($project);
        for ($i=1; $i <= 2; $i++) {
            $user = User::firstWhere("email", $project_form['email_'.$i]);
            $supervisor = Supervisor::firstWhere("user_id", $user->id);
            $supervisor->graduation_project_id = $project->id;
            $supervisor->save();
        }
    }

    private function removeStudents($project){
        $in_project = Student::where("graduation_project_id", $project->id)->get();
        foreach($in_project as $student){
            $student->graduation_project_id = null;
            $student->save();
        }
    }

    private function removeSupervisor($project){
        $in_project = Supervisor::where("graduation_project_id", $project->id)->get();
        foreach($in_project as $supervisor){
            $supervisor->graduation_project_id = null;
            $supervisor->save();
        }
    }








    public function setToNull($pk){
        $gp = Student::find($pk);
        $gp->graduation_project_id = null;
        $gp->save();
    }


    public function setToNulls($pk){
        $gp = Supervisor::find($pk);
        $gp->graduation_project_id = null;
        $gp->save();
    }

}
