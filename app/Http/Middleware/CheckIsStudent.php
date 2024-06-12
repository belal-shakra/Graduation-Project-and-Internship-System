<?php

namespace App\Http\Middleware;

use App\Models\Student;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $student = Student::firstWhere('user_id', User::firstWhere('email', $request->user()?->email)?->id);
        if($student){
            if ($this->check($student)){
                return $next($request);
            }
            Auth::logout();
            return to_route('student.login')->with('denied_permission', 'You haven\'t permission to login.');
        }
        else{
            Auth::logout();
            return to_route('student.login')->with('denied_permission', 'You haven\'t permission to login.');
        }
    }



    private function check(Student $student){
        if($student->hour < 90)
            return false;
        elseif(!$student->in_graduation_project && !$student->in_internship)
            return false;
        else
            return true;
    }


}
