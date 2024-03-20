<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Enquiry;
use App\Models\Leads;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $userRole = \Auth::User()->roles()->first();
        $userId = \Auth::id();
        if ($userRole->name == "Superadmin") {
            //per day enquiry data
            $currentDate = now()->toDateString();
            $todayenquiry = Enquiry::whereDate('created_at', $currentDate)->where('is_deleted', 0)->count();
            $todayleads = Leads::whereDate('created_at', $currentDate)->where('is_deleted', 0)->count();
            $todayapprovedleads = Leads::whereDate('created_at', $currentDate)->where('is_deleted', 0)->where('proccess_status', 'approved')->count();
            $todayrejectedleads = Leads::whereDate('created_at', $currentDate)->where('is_deleted', 0)->where('proccess_status', 'rejected')->count();
            // total enquiry count
            $enquiry = Enquiry::where('is_deleted', 0)->count();
            $leads = Leads::where('is_deleted', 0)->count();
            $approvedLeads = Leads::where('is_deleted', 0)->where('proccess_status', 'approved')->count();
            $pendingLeads = Leads::where('is_deleted', 0)->whereIn('proccess_status', ['proccessing', 'created'])->count();

            //show all users leads data
            $userLeads = User::withoutRole("Superadmin")
                ->select(
                    'users.username',
                    DB::raw('COUNT(leads.id) as total_leads'),
                    DB::raw('SUM(CASE WHEN leads.proccess_status = "approved" THEN 1 ELSE 0 END) as total_approved_leads'),
                    DB::raw('SUM(CASE WHEN leads.proccess_status = "rejected" THEN 1 ELSE 0 END) as total_rejected_leads')
                )
                ->leftJoin('leads', function ($join) use ($currentDate) {
                    $join->on('users.id', '=', 'leads.assigned_by')
                        ->whereDate('leads.created_at', $currentDate)
                        ->where('leads.is_deleted', 0);
                })
                ->groupBy('users.username')
                ->get();

            $usernames = [];
            $totalLeads = [];
            $totalApprovedLeads = [];
            $totalRejectedLeads = [];

            foreach ($userLeads as $userLead) {
                $usernames[] = $userLead->username;
                $totalLeads[] = $userLead->total_leads;
                $totalApprovedLeads[] = $userLead->total_approved_leads;
                $totalRejectedLeads[] = $userLead->total_rejected_leads;
            }

            $usernamesJson = json_encode($usernames);
            $totalLeadsJson = json_encode($totalLeads);
            $totalApprovedLeadsJson = json_encode($totalApprovedLeads);
            $totalRejectedLeadsJson = json_encode($totalRejectedLeads);

            $data = ([
                'todayenquiry' => $todayenquiry,
                'todayleads' => $todayleads,
                'todayapprovedleads' => $todayapprovedleads,
                'todayrejectedleads' => $todayrejectedleads,

                'pending' => $pendingLeads,
                'approved' => $approvedLeads,
                'leads' => $leads,
                'enquiry' => $enquiry
            ]);


        } else {
            // per day enquiry data according to user
            $currentDate = now()->toDateString();
            $todayenquiry = Enquiry::whereDate('created_at', $currentDate)->where('is_deleted', 0)->where('assigned_by', $userId)->count();
            $todayleads = Leads::whereDate('created_at', $currentDate)->where('is_deleted', 0)->where('assigned_by', $userId)->count();
            $todayapprovedleads = Leads::whereDate('created_at', $currentDate)->where('is_deleted', 0)->where('assigned_by', $userId)->where('proccess_status', 'approved')->count();
            $todayrejectedleads = Leads::whereDate('created_at', $currentDate)->where('is_deleted', 0)->where('assigned_by', $userId)->where('proccess_status', 'rejected')->count();

            //total enquiry data according to user
            $enquiry = Enquiry::where('assigned_by', $userId)->where('is_deleted', 0)->count();
            $leads = Leads::where('assigned_by', $userId)->where('is_deleted', 0)->count();
            $approvedLeads = Leads::where('is_deleted', 0)->where('assigned_by', $userId)->where('proccess_status', 'approved')->count();
            $pendingLeads = Leads::where('assigned_by', $userId)->where('is_deleted', 0)->whereIn('proccess_status', ['proccessing', 'created'])->count();

            $userLeads = User::select(
                'users.username',
                DB::raw('COUNT(leads.id) as total_leads'),
                DB::raw('SUM(CASE WHEN leads.proccess_status = "approved" THEN 1 ELSE 0 END) as total_approved_leads'),
                DB::raw('SUM(CASE WHEN leads.proccess_status = "rejected" THEN 1 ELSE 0 END) as total_rejected_leads')
            )
                ->leftJoin('leads', function ($join) use ($currentDate, $userId) {
                    $join->on('users.id', '=', 'leads.assigned_by')
                        ->whereDate('leads.created_at', $currentDate)
                        ->where('leads.assigned_by', $userId) // Filter leads by $userId
                        ->where('leads.is_deleted', 0);
                })
                ->where('users.id', $userId)
                ->groupBy('users.username')
                ->first();

                $usernamesJson = json_encode([$userLeads->username]); 
                $totalLeadsJson = json_encode([$userLeads->total_leads]); 
                $totalApprovedLeadsJson = json_encode([$userLeads->total_approved_leads]); 
                $totalRejectedLeadsJson = json_encode([$userLeads->total_rejected_leads]); 

            $data = ([
                'todayenquiry' => $todayenquiry,
                'todayleads' => $todayleads,
                'todayapprovedleads' => $todayapprovedleads,
                'todayrejectedleads' => $todayrejectedleads,

                'pending' => $pendingLeads,
                'approved' => $approvedLeads,
                'leads' => $leads,
                'enquiry' => $enquiry
            ]);

        }
        return view('dashboard', compact('data', 'usernamesJson', 'totalLeadsJson', 'totalApprovedLeadsJson', 'totalRejectedLeadsJson'));
    }
}
