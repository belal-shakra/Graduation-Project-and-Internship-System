<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Student;
use App\Models\UserType;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    // public function create(): View
    // {
    //     return view('student.login');
    // }

    /**
     * Handle an incoming authentication requeest.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();



        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

        if($route == 'student.login')
            return to_route('student.home');
        else
            return to_route('supervisor.home');

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();


        $url = url()->previous();
        $route_prefix = app('router')->getRoutes($url)->match(app('request')->create($url))->action['prefix'];

        if($route_prefix == '')
            return redirect('/');
        elseif ($route_prefix == '/supervisor')
            return redirect('/supervisor/login');
    }
}
