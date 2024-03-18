<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Enquiry;
use App\Models\Leads;

class DashboardController extends Controller
{
    public function index(){
        $userRole = \Auth::User()->roles()->first();
        $userId = \Auth::id();
        if($userRole->name == "Superadmin"){
            $enquiry = Enquiry::where('is_deleted',0)->count();
            $leads = Leads::where('is_deleted',0)->count();
            $approvedLeads = Leads::where('is_deleted',0)->where('proccess_status','approved')->count();
            $pendingLeads = Leads::where('is_deleted',0)->whereIn('proccess_status',['proccessing','created'])->count();
        }else{
            $enquiry = Enquiry::where('assigned_by',$userId)->where('is_deleted',0)->count();
            $leads = Leads::where('assigned_by',$userId)->where('is_deleted',0)->count();
            $approvedLeads = Leads::where('is_deleted',0)->where('assigned_by',$userId)->where('proccess_status','approved')->count();
            $pendingLeads = Leads::where('assigned_by',$userId)->where('is_deleted',0)->whereIn('proccess_status',['proccessing','created'])->count();
        }
        return view('dashboard',compact('enquiry','leads','approvedLeads','pendingLeads'));
    }
}
