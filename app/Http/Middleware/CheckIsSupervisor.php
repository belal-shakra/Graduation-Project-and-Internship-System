<?php

namespace App\Http\Middleware;

use App\Models\Supervisor;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsSupervisor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        $supervisor = Supervisor::firstWhere('user_id', User::firstWhere('email', $request->user()?->email)?->id);
        if($supervisor){
            return $next($request);
        }
        else{
            Auth::logout();
            return to_route('supervisor.login')->with('denied_permission', 'You haven\'t permission to login.');
        }
    }
}
