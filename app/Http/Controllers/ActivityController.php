<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function getActivities(Request $request)
    {
       $activities = Activity::orderBy('created_at', 'desc') 
       ->get()->groupBy(function($date) {
        return Carbon::parse($date->date)->format('Y-m-d'); 
       });
        return view("activity.Allactivities", compact("activities"));
    }
}
