<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function getActivities(Request $request)
    {

        $userRole = \Auth::User()->roles()->first();
        $userId = \Auth::id();
        if($userRole->name == "Superadmin"){
            $activities = Activity::orderBy('created_at', 'desc') 
            ->get()->groupBy(function($date) {
                return Carbon::parse($date->date)->format('Y-m-d'); 
            });
            $readAllRecivedNotify = Activity::Where('admin_read',0)->update(['admin_read' => 1]);
        }else{
            $activities = Activity::orderBy('created_at', 'desc')->where('sender_id',$userId)->orWhere('receiver_id',$userId)
            ->get()->groupBy(function($date) {
             return Carbon::parse($date->date)->format('Y-m-d'); 
            });
            $readAllRecivedNotify = Activity::Where('receiver_id',$userId)->where('reciver_read',0)->update(['reciver_read' => 1]);
        }
        return view("activity.Allactivities", compact("activities"));
    }

}
