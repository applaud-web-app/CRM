<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Enquiry;
use App\Models\Leads;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userRole = \Auth::User()->roles()->first();
        $userId = \Auth::id();
        if ($userRole->name == "Superadmin") {

            $currentDate = now()->toDateString();
            $todayenquiry=Enquiry::whereDate('created_at', $currentDate)->count();
            $todayleads= Leads::whereDate('created_at', $currentDate)->count();
            $todayapprovedleads= Leads::whereDate('created_at', $currentDate)->where('proccess_status', 'approved')->count();
            $todayrejectedleads= Leads::whereDate('created_at', $currentDate)->where('proccess_status', 'rejected')->count();

            $enquiry = Enquiry::where('is_deleted', 0)->count();
            $leads = Leads::where('is_deleted', 0)->count();
            $approvedLeads = Leads::where('is_deleted', 0)->where('proccess_status', 'approved')->count();
            $pendingLeads = Leads::where('is_deleted', 0)->whereIn('proccess_status', ['proccessing', 'created'])->count();

            $data=([
                'todayenquiry'=> $todayenquiry,
                'todayleads'=> $todayleads,
                'todayapprovedleads'=> $todayapprovedleads,
                'todayrejectedleads'=> $todayrejectedleads,

                'pending'=> $pendingLeads,
                'approved'=> $approvedLeads,
                'leads'=>$leads,
                'enquiry'=>$enquiry
            ]);

        } else {

            $currentDate = now()->toDateString();
            $todayenquiry=Enquiry::whereDate('created_at', $currentDate)->where('assigned_by',$userId)->count();
            $todayleads= Leads::whereDate('created_at', $currentDate)->where('assigned_by',$userId)->count();
            $todayapprovedleads= Leads::whereDate('created_at', $currentDate)->where('assigned_by',$userId)->where('proccess_status', 'approved')->count();
            $todayrejectedleads= Leads::whereDate('created_at', $currentDate)->where('assigned_by',$userId)->where('proccess_status', 'rejected')->count();
            
            $enquiry = Enquiry::where('assigned_by', $userId)->where('is_deleted', 0)->count();
            $leads = Leads::where('assigned_by', $userId)->where('is_deleted', 0)->count();
            $approvedLeads = Leads::where('is_deleted', 0)->where('assigned_by', $userId)->where('proccess_status', 'approved')->count();
            $pendingLeads = Leads::where('assigned_by', $userId)->where('is_deleted', 0)->whereIn('proccess_status', ['proccessing', 'created'])->count();
            $data=([
                'todayenquiry'=> $todayenquiry,
                'todayleads'=> $todayleads,
                'todayapprovedleads'=> $todayapprovedleads,
                'todayrejectedleads'=> $todayrejectedleads,

                'pending'=> $pendingLeads,
                'approved'=> $approvedLeads,
                'leads'=>$leads,
                'enquiry'=>$enquiry
            ]);

        }
        return view('dashboard', compact('data'));
    }
}
