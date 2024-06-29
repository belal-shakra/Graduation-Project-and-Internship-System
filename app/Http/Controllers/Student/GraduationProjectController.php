<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGraduationProjectRequest;
use App\Models\Department;
use App\Models\GraduationProject;
use App\Models\Notification;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\User;
use App\Models\UserType;
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


        $gp = Auth::user()->student->graduation_project;
        if($gp){
            return redirect()->route('student.graduation-project.edit');
        }
        else {
            $student_no = Auth::user()->student->user->department->no_team_member;
            return view('student.Graduation-Project.reg-gp', compact(['student_no']));
        }
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGraduationProjectRequest $request)
    {
        $gp_form = $request->validated();
        
        
        if(!$this->checkUser($request)){
            return redirect()->route("student.graduation-project.create");
        }
        
        $gpModel = GraduationProject::create($gp_form);
        
        $this->addStudents($gpModel);
        $this->addSupervisors($gpModel);


        $this->send_to_department('A new Team is created.');

        return redirect()->route('student.graduation-project.edit')->with('GpFilledSuccessfully', 'The Form has been filled successfully.');
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GraduationProject $graduation_project)
    {

        $isInGp = Student::firstWhere('user_id', Auth::user()->id)->graduation_project_id;
        if(!$isInGp)
            return redirect()->route('student.graduation-project.create');

        $gp = GraduationProject::find($isInGp);
        // $acceptedStudents = session('acceptedStudents', []);
        // $rejectedStudents = session('rejectedStudents', []);
        // $rejectedSupervisors = session('rejectedSupervisors', []);


        $student_no = Department::find(Auth::user()->department_id)->no_team_member;
        return view('student.Graduation-Project.edit-gp', compact(['student_no', 'gp',]));
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGraduationProjectRequest $request, GraduationProject $graduation_project)
    {
        $updatedForm = $request->validated();
        
        if(!$this->checkUser($request, $graduation_project->id)){
            return redirect()->route("student.graduation-project.edit");
        }


        $graduation_project->update($updatedForm);
        $this->addStudents($graduation_project);
        $this->addSupervisors($graduation_project);

        $this->send_to_department('A team edit Gradution Project Info.');

        return redirect()->route('student.graduation-project.edit')->with('GpUpdateSuccessfully', 'The Form has been updated successfully.');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GraduationProject $graduation_project)
    {
        //
    }





    private function checkUser($request, $graduation_project=PHP_INT_MAX){

        $flag = true;
        if (!$this->checkStudents($request, $graduation_project))
            $flag = false;

        if(!$this->checkSupervisor($request, $graduation_project))
            $flag = false;


        if($flag)
            return true;
        return false;
    }



    /**
     * Check if the registered students can be added to the graduation project team.
     * 
     * @param Request $request the request that contains the graduation project form.
     * @return boolean true, if the accepted students more than two, false otherwise.
     */
    private function checkStudents($request, $graduation_project=PHP_INT_MAX)
    {

        $acceptedStudents = [];
        $rejectedStudents = [];

        $alreay = " already registered in other team.";
        $notStudent = " is not a student.";
        $isNotInGp = " isn't registered in graduation project.";
        $wrongDepartment = " isn't from ". Auth::user()->department->name . " department.";



        $acceptedStudents[Auth::user()->id] = Auth::user();

        $rejected_count = 0;
        for ($i=1; $i <= Auth::user()->department->no_team_member; $i++) {

            // check if any field is empty (except spaces).
            if(!$request['name'.$i] || !$request['stu_id'.$i] || !$request['major'.$i]){
                $rejected_count++;
                // dd($request['name'.$i]);
                continue;
            }

            // check if the authenticated user register in the form.
            if($request['stu_id'.$i] == Auth::user()->university_id)
                continue;

            /*
                check about some info: is user and student, frome same department,
                registered in graduation project, and if in other team.
            */
            $user = User::firstWhere('university_id', $request['stu_id'.$i]);
            $full_name = $user?->first_name.' '.$user?->last_name;
            if(!$user?->student){
                array_push($rejectedStudents, '( '. $request['name'.$i]. '---' . $request['stu_id'.$i] . ' )' . $notStudent);
                $rejected_count++;
                continue;
            }
            elseif($user->student->graduation_project_id == $graduation_project){
                array_push($acceptedStudents, $user);
            }
            elseif($user->department_id != Auth::user()->department_id){
                array_push($rejectedStudents, '( '. $full_name .' --- ' . $user->university_id .' )'. $wrongDepartment);
                $rejected_count++;
                continue;
            }
            elseif(!$user->student->in_graduation_project){
                array_push($rejectedStudents, '( '. $full_name.' --- ' . $user->university_id .' )'. $isNotInGp);
                $rejected_count++;
                continue;
            }
            elseif($user->student->graduation_project_id){
                array_push($rejectedStudents, '( '. $full_name .' --- ' . $user->university_id .' )'. $alreay);
                $rejected_count++;
                continue;
            }
            else{
                $acceptedStudents[$user->id] = $user;
            }


            // check if the number of accespted students equal to max number can be added.
            if(count($acceptedStudents) == Auth::user()->department->no_team_member)
                break;
        }


        session(['rejectedStudents' => $rejectedStudents]);
        session(['acceptedStudents' => $acceptedStudents]);


        if($rejected_count == 4 || count($acceptedStudents) == 1)
            return false;
        return true;
    }



    /**
     * Check if the registered supervisors can be supervise the graduation project team.
     * 
     * @param Request $request the request that contains the graduation project form.
     * @return boolean true, if the two supervisors accepted, false otherwise.
     */
    private function checkSupervisor($request, $graduation_project=PHP_INT_MAX)
    {
        $acceptedSupervisor = [];
        $rejectedSupervisor = [];
        $isNotSupervisor = " is not a supervisor.";
        $notSameDept = " is not from " . Auth::user()->department->name . " department.";


        $flag = true;
        for ($i=1; $i <= 2; $i++) {

            $user = User::firstWhere('email', $request['email_'.$i]);
            $full_name = $user?->first_name .' '. $user?->first_name;

            if(!$user?->supervisor){
                array_push($rejectedSupervisor, $request['supervisor_'.$i] . $isNotSupervisor);
                $flag = false;
            }
            elseif($user->department_id != Auth::user()->department_id){
                array_push($rejectedSupervisor, $full_name . $notSameDept);
                $flag = false;
            }
            else{
                array_push($acceptedSupervisor, $user);
            }
        }



        session(['acceptedSupervisors' => $acceptedSupervisor]);
        session(['rejectedSupervisors' => $rejectedSupervisor]);


        if($flag)
            return true;
        return false;
    }




    private function addStudents($project) {

        $this->removeStudents($project);
        foreach(session('acceptedStudents', []) as $user){
            $user->student->graduation_project_id = $project->id;
            $user->student->save();
        }
    }

    private function addSupervisors($project){

        $this->removeSupervisors($project);
        foreach(session('acceptedSupervisors', []) as $user){
            $user->supervisor->graduation_projects()->attach($project->id);
            $this->sned_to_supervisor($user->id, 'You\'re a supervisor for a Graduation Project Team.');
        }
    }


    private function removeStudents($project){

        $accepted = session('acceptedStudents', []);
        foreach($project->students as $student){
            if(!array_key_exists($student->user_id, $accepted))
                $student->graduation_project_id = null;
                $student->save();
        }
    }

    private function removeSupervisors($project){
        
        foreach($project->supervisors as $supervisor){
            $supervisor->graduation_projects()->detach($project->id);
        }
    }



    public function sned_to_supervisor($supervisor_id, $message){
        Notification::create([
            'title'   => 'Graduation Project | Create',
            'message' => $message,
            'type'    => 'supervisor',
            'is_read' => false,
            'user_id' => $supervisor_id,
        ]);
    }


    private function send_to_department($message){
        $user_type = UserType::firstWhere('name', 'supervisor&head')->id;
        $head_id = User::where('user_type_id', $user_type)->firstWhere('department_id', Auth::user()->department_id)->id;

        Notification::create([
            'title'   => 'Graduation Project | Create',
            'message' => $message,
            'type'    => 'department',
            'is_read' => false,
            'user_id' => $head_id,
        ]);
    }

}
