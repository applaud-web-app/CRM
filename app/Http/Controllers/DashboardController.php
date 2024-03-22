<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Enquiry;
use App\Models\Leads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
            $todaypendingleads = Leads::whereDate('created_at', $currentDate)->where('is_deleted', 0)->where('proccess_status', 'proccessing')->count();
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

            $enquirydata = Enquiry::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $leadsData = Leads::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count, proccess_status as status')
                ->addSelect('proccess_status')
                ->whereIn('proccess_status', ['created', 'proccessing', 'rejected', 'approved'])
                ->groupBy('month', 'proccess_status')
                ->orderBy('month')
                ->get();

            $data2 = Leads::whereIn("proccess_status", ['created', 'proccessing', 'rejected', 'approved'])->get();
            $leadcount = ([
                'total' => $data2->count(),
                'pending' => $data2->where('proccess_status', 'proccessing')->count(),
                'rejected' => $data2->where('proccess_status', 'rejected')->count(),
                'approved' => $data2->where('proccess_status', 'approved')->count(),
            ]);

            $chartdata = Leads::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $data = ([
                'todayenquiry' => $todayenquiry,
                'todayleads' => $todayleads,
                'todayapprovedleads' => $todayapprovedleads,
                'todayrejectedleads' => $todayrejectedleads,
                'todaypendingleads' =>$todaypendingleads,
                'pending' => $pendingLeads,
                'approved' => $approvedLeads,
                'leads' => $leads,
                'enquiry' => $enquiry
            ]);

            $employees=User::withoutRole("Superadmin")->count();

            //leads approved
            $role='Superadmin';
            $leadsapproved=$this->getapprovedleads("Superadmin");
            $leadsrejected=$this->getrejectedleads($role);
            $leadspending=$this->getpendingleads($role);
        } else {
            // per day enquiry data according to user
            $currentDate = now()->toDateString();
            $todayenquiry = Enquiry::whereDate('created_at', $currentDate)->where('is_deleted', 0)->where('assigned_by', $userId)->count();
            $todayleads = Leads::whereDate('created_at', $currentDate)->where('is_deleted', 0)->where('assigned_by', $userId)->count();
            $todayapprovedleads = Leads::whereDate('created_at', $currentDate)->where('is_deleted', 0)->where('assigned_by', $userId)->where('proccess_status', 'approved')->count();
            $todayrejectedleads = Leads::whereDate('created_at', $currentDate)->where('is_deleted', 0)->where('assigned_by', $userId)->where('proccess_status', 'rejected')->count();
            $todaypendingleads = Leads::whereDate('created_at', $currentDate)->where('is_deleted', 0)->where('assigned_by', $userId)->where('proccess_status', 'proccessing')->count();
            
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

            $enquirydata = Enquiry::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')->where('assigned_by', $userId)
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $leadsData = Leads::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count, proccess_status as status')
                ->addSelect('proccess_status')
                ->where('assigned_by', $userId)
                ->whereIn('proccess_status', ['created', 'proccessing', 'rejected', 'approved'])
                ->groupBy('month', 'proccess_status')
                ->orderBy('month')
                ->get();


            $data2 = Leads::whereIn("proccess_status", ['created', 'proccessing', 'rejected', 'approved'])->where('assigned_by', $userId)->get();
            $leadcount = ([
                'total' => $data2->count(),
                'pending' => $data2->where('proccess_status', 'proccessing')->count(),
                'rejected' => $data2->where('proccess_status', 'rejected')->count(),
                'approved' => $data2->where('proccess_status', 'approved')->count(),
            ]);

            $chartdata = Leads::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')->where('assigned_by', $userId)
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $data = ([
                'todayenquiry' => $todayenquiry,
                'todayleads' => $todayleads,
                'todayapprovedleads' => $todayapprovedleads,
                'todayrejectedleads' => $todayrejectedleads,
                'todaypendingleads' =>$todaypendingleads,
                'pending' => $pendingLeads,
                'approved' => $approvedLeads,
                'leads' => $leads,
                'enquiry' => $enquiry
            ]);

            $employees=0;
            $role='';
            $leadsapproved=$this->getapprovedleads($role);
            $leadsrejected=$this->getrejectedleads($role);
            $leadspending=$this->getpendingleads($role);

        }
        return view('dashboard', compact('data','leadcount','chartdata','enquirydata', 'leadsData', 'usernamesJson', 'totalLeadsJson', 'totalApprovedLeadsJson', 'totalRejectedLeadsJson','employees',
        'leadsapproved','leadsrejected','leadspending'));
    }


    public function getapprovedleads($role)
    {   $userId = Auth::id();
        if(($role=='Superadmin'))
        {
            $data=Leads::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')->where('proccess_status','approved')
            ->groupBy('month')
            ->orderBy('month')->get();
            $jsondata=json_encode($data);
            return $jsondata;
        }
        else if($role=='')
        {
            $data=Leads::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')->where('proccess_status','approved')->where('assigned_by',$userId)
            ->groupBy('month')
            ->orderBy('month')
            ->get()->toArray();
            $jsondata=json_encode($data);
            return $jsondata;
        }
    }

    public function getrejectedleads($role)
    {
        $userId = Auth::id();
        if(($role=='Superadmin'))
        {
            $data=Leads::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')->where('proccess_status','rejected')
            ->groupBy('month')
            ->orderBy('month')->get();
            $jsondata=json_encode($data);
            return $jsondata;
        }
        else if($role=='')
        {
            $data=Leads::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')->where('proccess_status','rejected')->where('assigned_by',$userId)
            ->groupBy('month')
            ->orderBy('month')
            ->get()->toArray();
            $jsondata=json_encode($data);
            return $jsondata;
        }
    }

        public function getpendingleads($role)
        {
            $userId = Auth::id();
            if(($role=='Superadmin'))
            {
                $data=Leads::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')->where('proccess_status','proccessing')
                ->groupBy('month')
                ->orderBy('month')->get();
                $jsondata=json_encode($data);
                return $jsondata;
            }
            else if($role=='')
            {
                $data=Leads::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')->where('proccess_status','proccessing')->where('assigned_by',$userId)
                ->groupBy('month')
                ->orderBy('month')
                ->get()->toArray();
                $jsondata=json_encode($data);
                return $jsondata;
            }
        }

}
