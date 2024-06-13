<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NoificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $type = Auth::user()->user_type->name;

                $url = url()->current();
                $route_prefix = app('router')->getRoutes($url)->match(app('request')->create($url))->action['prefix'];

                if($route_prefix == '/department')
                    $type = 'department';
                elseif($route_prefix != '')
                    $type = 'supervisor';
                
                
                $notifications = Notification::where('user_id', Auth::user()->id)->where('type', $type)->orderByDesc('created_at')->get();

                $there_is = false;
                foreach($notifications as $notification)
                    if(!$notification->is_read){
                        $there_is = true;
                        break;
                    }

                $view->with('notifications', $notifications);
                $view->with('there_is', $there_is);
            }
        });
    }
}
