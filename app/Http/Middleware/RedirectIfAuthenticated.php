<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                return redirect($this->get_correct_redirect($request));
            }
        }

        return $next($request);
    }


    private function get_correct_redirect($request){

        switch (Auth::user()->user_type->name) {
            case 'student':
                return '/';
            
            case 'supervisor':
                return '/supervisor';
            
            case 'supervisor&head':
                $url = url()->previous();
                $route_prefix = app('router')->getRoutes($url)->match(app('request')->create($url))->action['prefix'];
                if($route_prefix == '/supervisor'){
                    return '/supervisor';
                }
                else
                    return '/department';
        }
    }
}
