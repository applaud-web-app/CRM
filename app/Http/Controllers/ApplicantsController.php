<?php

namespace App\Http\Controllers;

use App\Helpers\Common;
use App\Models\Activity;
use App\Models\Documents;
use App\Models\Followup;
use Illuminate\Http\Request;
use App\Models\Leads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ApplicantsController extends Controller
{
    // public function showAppliance(Request $request)
    // {

    // }
    public function pendingApplicants(Request $request)
    {
        if ($request->ajax()) {
            $start = ($request->start) ? $request->start : 0;
            $pageSize = ($request->length) ? $request->length : 50;
            $leads = Leads::where("is_deleted", 0)
                ->where("proccess_status", "proccessing")
                ->with('employee')->orderBy('id', 'DESC')->skip($start)->take($pageSize);
            $count_total = Leads::where('is_deleted', 0)->where('proccess_status', "proccessing")->count();
            return DataTables::of($leads)
                ->addIndexColumn()
                ->editColumn('contacted_date', function ($dateformat) {
                    return $dateformat->contacted_date ? $dateformat->contacted_date->format('d-M-y') : '';
                })
                ->addColumn('action', function ($row) {

                    $dropdown = '<div class="dropdown text-sans-serif">
                    <button class="btn btn-primary light sharp" type="button" id="order-dropdown-0" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                       <span>
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                             <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                             </g>
                          </svg>
                       </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="order-dropdown-0">
                       <div class="py-2">
                          <a class="dropdown-item" href="' . route('viewapplicant', $row->id) . '"><i class="far fa-eye"></i> View Lead</a>  
                    
                          <a class="dropdown-item" href="'.route('approved',$row->id).'"><i class="fas fa-check"></i> Accept Lead</a>
                          <a class="dropdown-item" href="' . route('rejectapproval', $row->id) . '"><i class="fas fa-trash-alt"></i> Reject Lead</a>
                       </div>
                    </div>
                 </div>';
                    return $dropdown;
                })
                ->rawColumns(['action'])
                ->setTotalRecords($count_total)
                ->make(true);
        } else {
            return view("applicants.Pendingapplicants");
        }
    }

    public function viewApplicantData(Request $request, $id)
    {
        $data = Leads::select('leads.*', 'countries.name as country_name', 'states.name as state_name', 'cities.name as city_name')
            ->leftJoin('countries', 'leads.country', '=', 'countries.id')
            ->leftJoin('states', 'leads.state', '=', 'states.id')
            ->leftJoin('cities', 'leads.city', '=', 'cities.id')
            ->where('leads.id', $id)->where('proccess_status','proccessing')
            ->first();
        $documents = Documents::where('leads_id', $id)->select('document','document_name')->get();
        $followupdata = Followup::where('lead_id', $id)->select('serial_id', 'notes', 'next_followup', 'added_by')->get();
        return view("applicants.Viewdata", compact("data", 'documents', "followupdata"));

    }

    public function rejectApproval($id)
    {   $common=new Common();
        $user_id= Auth::id();
        $username=Auth::user()->username;
        $lead=Leads::where('id',$id)->first();
        $approval = Leads::where("id", $id)->update(["proccess_status" => 'rejected']);
        if($approval)
        {       
            $note="Lead with name ".$lead->name." was rejected by ".$username;
            if(Auth::user()->hasRole('Superadmin')) 
            {
                Activity::create([
                    "sender_id"=>$user_id,
                    "receiver_id"=>$lead->assigned_to,
                    "activity"=>$note,
                    "done_by"=>$username,
                    "admin_read"=> 1,
                    "date" => date('y-m-d')
                ]);
            }
            else
            {
                Activity::create([
                    "sender_id"=>$user_id,
                    "receiver_id"=>$lead->assigned_to,
                    "activity"=>$note,
                    "done_by"=>$username,
                    "admin_read"=>0,
                    "date" => date('y-m-d')
                ]);
            }        
            $common->sendNotification($user_id,$lead->assigned_to,$note);
            return redirect()->route("leads")->with("error","Approval for this lead was rejected");
        }
    }

    public function approvedRequest($id)
    {
        $common=new Common();
        $user_id= Auth::id();
        $username=Auth::user()->username;
        $lead=Leads::where('id',$id)->first();
        $approved = Leads::where("id", $id)->update(["proccess_status"=> "approved"]);
        if($approved)
        {   
            $note="Lead with name ".$lead->name." was approved by ".$username;
            if(Auth::user()->hasRole('Superadmin')) 
            {
                Activity::create([
                    "sender_id"=>$user_id,
                    "receiver_id"=>$lead->assigned_to,
                    "activity"=>$note,
                    "done_by"=>$username,
                    "admin_read"=>1,
                    "date" => date('y-m-d')
                ]);
            }
            else
            {
                Activity::create([
                    "sender_id"=>$user_id,
                    "receiver_id"=>$lead->assigned_to,
                    "activity"=>$note,
                    "done_by"=>$username,
                    "admin_read"=>0,
                    "date" => date('y-m-d')
                ]);
            }
            $common->sendNotification($user_id,$lead->assigned_to,$note);
            return redirect()->route("leads")->with("success","Lead approved");
        }
    }

    public function allApplicants(Request $request){
        if ($request->ajax()) {
            $start = ($request->start) ? $request->start : 0;
            $pageSize = ($request->length) ? $request->length : 50;
            $leads = Leads::where("is_deleted", 1)
                ->where("proccess_status", "approved")
                ->orderBy('id', 'DESC')->skip($start)->take($pageSize);
            $count_total = Leads::where('is_deleted', 1)->where('proccess_status', "approved")->count();
            return DataTables::of($leads)
                ->addIndexColumn()
                ->editColumn('email', function ($contact) {
                    return $contact->email.' '.$contact->mobile;
                })
                ->addColumn('action', function ($row) {

                    $dropdown = '<div class="dropdown text-sans-serif">
                    <button class="btn btn-primary light sharp" type="button" id="order-dropdown-0" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                       <span>
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                             <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                             </g>
                          </svg>
                       </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="order-dropdown-0">
                       <div class="py-2">
                          <a class="dropdown-item" href="' . route('applicantdata', $row->id) . '"><i class="far fa-eye"></i> View Lead</a>  
                    
                          <a class="dropdown-item" href="'.route('approved',$row->id).'"><i class="fas fa-check"></i> Accept Lead</a>
                          <a class="dropdown-item" href="' . route('rejectapproval', $row->id) . '"><i class="fas fa-trash-alt"></i> Reject Lead</a>
                       
                       
                       </div>
                    </div>
                 </div>';
                    return $dropdown;
                })
                ->rawColumns(['action'])
                ->setTotalRecords($count_total)
                ->make(true);
        } else {   
        return view('applicants.Applicants');}
    }

    public function addNewApplicant()
    {
        $countries=DB::table('countries')->get();
        return view('applicants.Newapplicant',compact('countries'));
    }

    public function applicantDetails($id)
    {   
        $data = Leads::select('leads.*', 'countries.name as country_name', 'states.name as state_name', 'cities.name as city_name')
            ->leftJoin('countries', 'leads.country', '=', 'countries.id')
            ->leftJoin('states', 'leads.state', '=', 'states.id')
            ->leftJoin('cities', 'leads.city', '=', 'cities.id')
            ->where('leads.id', $id)->where('proccess_status','approved')
            ->first();
        if($data !=NUll)
        {
            $documents = Documents::where('leads_id', $id)->select('document','document_name')->get();
            $followupdata = Followup::where('lead_id', $id)->select('serial_id', 'notes', 'next_followup', 'added_by')->get();
            return view("applicants.Applicantdetails",compact("data","documents","followupdata"));
        }
        else 
            return redirect()->back()->with("error","No such user Exists");
    }

    public function postAddApplicant(Request $request)
    {
        $data=$request->except("_token");
        $document=$request->document;
        dd($document,$data);
    }

    public function sendRequest(Request $request,$id)
    {
        $common=new Common();
        $user_id= Auth::id();
        $username=Auth::user()->username;
        $lead= Leads::where('id',$id)->select("name","assigned_to")->first();
        $check=Leads::where("id", $id)->update([
            "notes"=> $request->notes,
        ]);
        if($check)
        {
            $note=$username." requested some documents from ".$lead->name;
            if(Auth::user()->hasRole('Superadmin')) 
            {
                Activity::create([
                    "sender_id"=>$user_id,
                    "receiver_id"=>$lead->assigned_to,
                    "activity"=>$note,
                    "done_by"=>$username,
                    "admin_read"=>1,
                    "date" => date('y-m-d')
                ]);
            }
            else
            {
                Activity::create([
                    "sender_id"=>$user_id,
                    "receiver_id"=>$lead->assigned_to,
                    "activity"=>$note,
                    "done_by"=>$username,
                    "admin_read"=>0,
                    "date" => date('y-m-d')
                ]);
            }
            $common->sendNotification($user_id,$lead->assigned_to,$note);
            return redirect()->back()->with('success','Request for document sent');
        }
        else
            return redirect()->back()->with('error','Error occured');
    }
}
