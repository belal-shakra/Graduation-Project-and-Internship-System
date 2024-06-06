<?php

namespace App\Http\Middleware;

use App\Models\Supervisor;
use App\Models\User;
use App\Models\UserType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsHead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supervisor_type_id = User::firstWhere('email', $request->user()?->email)?->user_type_id;
        $supervisor_type = UserType::find($supervisor_type_id)->name;
        if($supervisor_type == 'supervisor&head'){
            return $next($request);
        }
        else{
            Auth::logout();
            return to_route('department.login')->with('denied_permission', 'You haven\'t permission to login.');
        }
    }
}
