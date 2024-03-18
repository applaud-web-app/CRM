<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Leads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function allReports()
    {
        $userId = Auth::id();
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
        // dd($leadsData);
        json_encode($leadsData);
        return view('reports.allreports', compact('enquirydata','leadsData'));
    }
















    public function leadReports()
    {
        $data = Leads::whereIn("proccess_status", ['created', 'proccessing', 'rejected', 'approved'])->get();
        $leadcount = ([
            'total' => $data->count(),
            'pending' => $data->where('proccess_status', 'proccessing')->count(),
            'rejected' => $data->where('proccess_status', 'rejected')->count(),
            'approved' => $data->where('proccess_status', 'approved')->count(),
        ]);

        $chartdata = Leads::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        return view('reports.leadreports', compact('leadcount', 'chartdata'));
    }
}
