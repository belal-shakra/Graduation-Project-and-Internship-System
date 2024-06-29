<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function read_all(){

        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->action['as'];


        $notifications = Notification::where('user_id', Auth::user()->id)->where('type', explode('.', $route,2)[0])
        ->orderByDesc('created_at')->get();


        foreach($notifications as $notification){
            if(!$notification->is_read){
                $notification->is_read = true;
                $notification->save();
            }
        }


        return back();
    }


    public function read_one(Notification $notification){

        if(!$notification->is_read){
            $notification->is_read = true;
            $notification->save();
        }

        return redirect($notification->route);
    }

}
