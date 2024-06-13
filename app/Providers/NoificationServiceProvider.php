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

                $url = url()->current();
                $route = app('router')->getRoutes($url)->match(app('request')->create($url))->action['as'];
                $notifications = Notification::where('user_id', Auth::user()->id)->where('type', explode('.', $route,2)[0])->orderByDesc('created_at')->get();


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
