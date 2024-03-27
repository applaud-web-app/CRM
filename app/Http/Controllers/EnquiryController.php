<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Enquiry;
use App\Models\Leads;
use Illuminate\Http\Request;
use App\Imports\BulkEnquiry;
use App\Models\User;
use App\Models\Activity;
use App\Models\Documents;
use App\Models\Followup;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Common;
use App\Models\DocumentCategory;
use App\Imports\LeadsImports;
use Spatie\Permission\Models\Role;

class EnquiryController extends Controller
{
    public function loadenquiry(Request $request)
    {   
        $userid=Auth::id();
        if ($request->ajax()) {
        // if(Auth::user()->hasRole('Superadmin'))
        // {
            $start = ($request->start) ? $request->start : 0;
            $pageSize = ($request->length) ? $request->length : 50;
            $enquiries = Enquiry::where('status', 1)->where('is_deleted',0)->orderBy('id', 'DESC')->skip($start)->take($pageSize);
            $count_total = Enquiry::where('status', 1)->where('is_deleted',0)->count();  
        // }
        // else
        // {
        //     $start = ($request->start) ? $request->start : 0;
        //     $pageSize = ($request->length) ? $request->length : 50;
        //     $enquiries = Enquiry::where('status', 1)->where('assigned_by',$userid)->where('is_deleted',0)->orderBy('id', 'DESC')->skip($start)->take($pageSize);
        //     $count_total = Enquiry::where('status', 1)->where('assigned_by',$userid)->where('is_deleted',0)->count();
        // }
            return Datatables::of($enquiries)
                ->addIndexColumn()
                ->editColumn('created_at', function ($enquiry) {
                    return $enquiry->created_at->format('d-M-y');
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
                          <a class="dropdown-item edit-enquiry" href="#" data-bs-toggle="modal" data-bs-target="#editenquiry"
                          data-name="' . $row->name . '"
                          data-mobile="' . $row->mobile . '"
                          data-email="' . $row->email . '"
                          data-select="' . $row->interested . '" 
                          data-source="' . $row->source . '"
                          data-immigration="' . $row->type_of_immigration . '"
                          data-id="' . $row->id . '"
                          class="btn btn-primary mb-3"><i class="far fa-edit edit-btn "></i> Edit</a>
                          <a class="dropdown-item delete" href="' . route('deleteenquiry', $row->id) . '"><i class="fas fa-trash-alt"></i> Delete</a>
                         
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item text-secondary" href="' . route('convertenquiry', $row->id) . '"><i class="far fa-check-square"></i> Convert To Lead</a>
                       </div>
                    </div>';
                    return $dropdown;
                })
                ->rawColumns(['action'])
                ->setTotalRecords($count_total)
                ->make(true);
        }
        return view('Leadmanagement.Enquiry');
    }

    public function saveEnquiry(Request $request)
    {
        $userid = Auth::id();
        $data = $request->except("_token");
        $data["assigned_by"] = $userid;
        $enquiry = Enquiry::create($data);
        if ($enquiry) {
            return redirect()->route("enquiry")->with("success", "Enquiry Created !");
        } else {
            return redirect()->route("enquiry")->with("error", "Enquiry could not be created !");
        }
    }

    public function editenquiry(Request $request)
    {
        $data = $request->except("id", "_token");
        $id = $request->id;
        $check = Enquiry::where('id', $id)->update($data);
        if ($check) {
            return redirect()->route('enquiry')->with('success', 'Enquiry Updated');
        } else {
            return redirect()->route('enquiry')->with('error', 'Error Occured');
        }

    }

    public function deleteenquiry(Request $request, $id)
    {
        $check = Enquiry::where("id", $id)->update(["is_deleted" => 1]);
        if ($check) {
            return redirect()->route("enquiry")->with("success", "Enquiry Deleted");
        } else {
            return redirect()->route("enquiry")->with("error", "Error occured while deleting");
        }
    }

    public function bulkUploadEnquiry(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        try {
            Excel::import(new BulkEnquiry, request()->file('excel_file'));
            return redirect()->back()->with('success', 'Excel Uploaded Successfully 📤');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function convertToLead(Request $request, $id)
    {
        $data = Enquiry::find($id);
        $countries = DB::table('countries')->get();
        $users = User::withoutRole('Superadmin')->orderBy('id', 'DESC')->where('status', 1)->get();
        return view('Leadmanagement.ConvertEnquiry', compact('data', 'users', 'countries'));

    }

    public function leadGenerate(Request $request, $id)
    {
        $common=new Common();
        $data = $request->except("_token");
        $leadId = '#'.rand();
        $userid = Auth::id();
        $username = Auth::user()->username;
        $data["lead_mode"] = "converted";
        $data["assigned_by"] = $userid;
        $data["enquiry_id"] = $id;
        $data["code"] = $leadId;
        $check = Leads::create($data);
        if ($check) {
            $note="Enquiry converted into lead by ".$username;
            if(Auth::user()->hasRole('Superadmin')) {
                Activity::create([
                    "sender_id" => $userid,
                    "receiver_id" => $data['assigned_to'],
                    "activity" => $note,
                    "done_by" => $username,
                    "admin_read"=>1,
                    "date" => date('y-m-d')
                ]);
            }
            else
            {
                Activity::create([
                    "sender_id" => $userid,
                    "receiver_id" => $data['assigned_to'],
                    "activity" => $note,
                    "done_by" => $username,
                    "admin_read"=>0,
                    "date" => date('y-m-d')
                ]);
            }
            $common->sendNotification($userid,$data['assigned_to'],$note);
            Enquiry::where('id', $id)->update(['status' => 0]);
            return redirect()->route("leads")->with("success", "Enquiry Converted into Lead");
        } else {
            return redirect()->back()->with("error", "Failed to convert to lead");
        }

    }


    public function loadLeads(Request $request)
    {   
        $userid=Auth::id();
        if ($request->ajax()) {
            $start = ($request->start) ? $request->start : 0;
            $pageSize = ($request->length) ? $request->length : 50;
            $leads = Leads::where("is_deleted", 0)->whereIn('proccess_status', ['created', 'rejected'])->with('employee')->orderBy('id', 'DESC')->skip($start)->take($pageSize);
            $count_total = Leads::where('is_deleted', 0)->whereIn('proccess_status', ['created', 'rejected'])->count();
            return Datatables::of($leads)
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
                            <a class="dropdown-item" href="' . route('viewLeaddata', $row->id) . '"><i class="far fa-eye"></i> View</a> 
                            <a class="dropdown-item" href="' . route('editaddedlead', $row->id) . '"><i class="far fa-edit"></i> Edit</a>
                            <a class="dropdown-item" href="'. route('followup',$row->id).'"><i class="fas fa-phone"></i> Followup</a>
                            <a class="dropdown-item delete-leads" href="' . route('leaddelete', $row->id) .'"><i class="fas fa-trash-alt"></i> Delete</a>
                          <div class="dropdown-divider"></div>
                             <a class="dropdown-item text-success" href="' . route('applyapproval', $row->id) . '"><i class="fas fa-paper-plane"></i> Send For Approval</a>
                       </div>
                    </div>';
                    return $dropdown;
                })
                ->addColumn('lead_type', function ($lead) {
                    return $lead->lead_type;
                })
                ->addColumn('status', function ($status) {
                    return $status->status;
                })
                ->rawColumns(['action'])
                ->setTotalRecords($count_total)
                ->make(true);
        }
        return view('Leadmanagement.Leads');
        
    }

    public function leadDelete($id)
    {
        $check = Leads::where("id", $id)->update(["is_deleted" => 1]);
        if ($check) {
            return redirect()->route("leads")->with("success", "Lead Deleted");
        } else {
            return redirect()->route("leads")->with("error", "Lead could not be deleted");
        }
    }

    public function updateLeadType(Request $request, $id)
    {
        $check = Leads::where("id", $id)->update(["lead_type" => $request->leadtype,]);
        if ($check) {
            return "success";
        } else {
            return "failure";
        }
    }


    public function updateStatusType(Request $request, $id)
    {
        $check = Leads::where("id", $id)->update(["status" => $request->status,]);
        if ($check) {
            return "success";
        } else {
            return "failure";
        }
    }



    public function loadCreateLead(Request $request)
    {
        $users = User::withoutRole('Superadmin')->orderBy('id', 'DESC')->where('status', 1)->get();
        $countries = DB::table('countries')->get();
        return view('Leadmanagement.Createlead', compact('users', 'countries'));
    }

    public function createNewLead(Request $request)
    {   $common=new Common();
        $data = $request->except("_token");
        $id = Auth::id();
        $leadCode = "#".rand();
        $username = Auth::user()->username;
        $data["lead_mode"] = "added";
        $data["assigned_by"] = $id;
        $data["code"] = $leadCode;
        $check = Leads::create($data);
        if ($check) {
            $note="New Lead added manually by ".$username;
            if(Auth::user()->hasRole('Superadmin')) 
            {
                Activity::create([
                    "sender_id" => $id,
                    "receiver_id" => $data['assigned_to'],
                    "activity" =>$note,
                    "done_by" => $username,
                    "admin_read"=>1,
                    "date" => date('y-m-d')
                ]);
            }
            else
            {
                Activity::create([
                    "sender_id" => $id,
                    "receiver_id" => $data['assigned_to'],
                    "activity" =>$note,
                    "done_by" => $username,
                    "admin_read"=>0,
                    "date" => date('y-m-d')
                ]);
            }
            $common->sendNotification($id,$data['assigned_to'],$note);
            return redirect()->route("leads")->with("success", "New Lead created");
        } else {
            return redirect()->back("leads")->with("error", "Some Error occured");
        }
    }

    public function editNewAddedLead($id)
    {
        $data = Leads::find($id);
        $countries = DB::table('countries')->get();
        $states = DB::table('states')->where('country_id', $data->country)->get();
        $cities = DB::table('cities')->where('state_id', $data->state)->get();
        $users = User::withoutRole('Superadmin')->orderBy('id', 'DESC')->where('status', 1)->get();
        return view('Leadmanagement.Editlead', compact('data', 'users', 'countries', 'states', 'cities'));
    }

    public function updateLeadData(Request $request, $id)
    {
        $data = $request->except('_token');
        $check = Leads::where('id', $id)->update($data);
        if ($check) {
            return redirect()->route('leads')->with('success', 'Lead updated successfully');
        } else {
            return redirect()->back()->with('error', 'Lead not updated');
        }
    }

    public function loadStateData(Request $request)
    {
        $cid = $request->id;
        $data = DB::table('states')->where('country_id', $cid)->get();
        return $data;
    }

    public function loadCities(Request $request)
    {
        $sid = $request->id;
        $data = DB::table('cities')->where('state_id', $sid)->get();
        return $data;
    }

    public function applyApproval($id){
        $common=new Common();
        $userid = Auth::id();
        $username = Auth::user()->username;
        $leads = Leads::where('id',$id)->first();
        $documents = Documents::where('leads_id',$id)->orderBy('id','DESC')->get()->pluck('document_id')->toArray();
        $category_documents = DocumentCategory::where('type',$leads->interested)->where('subcategory',$leads->type_of_immigration)->orderBy('id','DESC')->get()->pluck('id')->toArray();

        $diff = array_diff($category_documents,$documents); // dd($diff,$category_documents,$documents);
        if(!count($diff) > 0){
            $check = Leads::where('id', $id)->update(['proccess_status' => 'proccessing','notes'=>'']);
            if ($check) 
            {   
                $note="Lead with name " . $leads->name . " was sent for approval";
                //enquiry points add
                $common->addenquiryPoints($leads,$note);
                    if(Auth::user()->hasRole('Superadmin')) 
                    {
                        Activity::create([
                            "sender_id" => $userid,
                            "receiver_id" => $leads->assigned_to,
                            "activity" => $note,
                            "done_by" => $username,
                            "admin_read"=>1,
                            "date" => date('y-m-d')
                        ]);
                    }
                    else
                    {
                        Activity::create([
                            "sender_id" => $userid,
                            "receiver_id" => $leads->assigned_to,
                            "activity" => $note,
                            "done_by" => $username,
                            "admin_read"=>0,
                            "date" => date('y-m-d')
                        ]);
                    }
                    $common->sendNotification($userid,$leads->assigned_to, $note);
                    return redirect()->route('pendingapplicants')->with("success", "Lead sent for approval.");
            }
            else
            {
                return redirect()->back()->with("error", "Something went wrong!");
            }
        }                      
        else
        {
            return redirect()->back()->with("error", "Please Fill all the documents before applying for approval");
        }
    }

    // public function applyApproval(Request $request, $id)
    // {
    //     $common=new Common();
    //     $userid = Auth::id();
    //     $username = Auth::user()->username;
    //     $lead = Leads::select('document_category.id as id','leads.name as Name','leads.assigned_to as assignedto','document_category.type as Type', 'document_category.name as documents')->where('leads.id',$id)->join('document_category',function($q){
    //         $q->on('document_category.subcategory','leads.type_of_immigration')->on('document_category.type','leads.interested');
    //     })->get();
        
    //     if ($lead) {
    //         $leadDocumentname = $lead->pluck('documents')->toArray();
    //         $allDocumentname = Documents::where('leads_id', $id)->pluck('document_name')->toArray();

    //         if (count($allDocumentname) >= count($leadDocumentname)) {
    //             $check = Leads::where('id', $id)->update(['proccess_status' => 'proccessing','notes'=>'']);
    //             if ($check) {
    //                 $note="Lead with name " . $lead->Name . " was sent for approval";
    //                 if(Auth::user()->hasRole('Superadmin')) 
    //                 {
    //                     Activity::create([
    //                         "sender_id" => $userid,
    //                         "receiver_id" => $lead->assignedto,
    //                         "activity" => $note,
    //                         "done_by" => $username,
    //                         "admin_read"=>1,
    //                         "date" => date('y-m-d')
    //                     ]);
    //                 }
    //                 else
    //                 {
    //                     Activity::create([
    //                         "sender_id" => $userid,
    //                         "receiver_id" => $lead->assignedto,
    //                         "activity" => $note,
    //                         "done_by" => $username,
    //                         "admin_read"=>0,
    //                         "date" => date('y-m-d')
    //                     ]);
    //                 }
    //                 $common->sendNotification($userid,$lead->assignedto, $note);
    //                 return redirect()->route('pendingapplicants')->with("success", "Lead sent for approval.");
    //             } else
    //                 return redirect()->back()->with("error", "Something went wrong!");
    //         } else
    //             return redirect()->back()->with("error", "Please Fill all the documents before applying for approval");
    //     }
    // }

    public function viewLeadData(Request $request, $id)
    {
        $data = Leads::select('leads.*', 'countries.name as country_name', 'states.name as state_name', 'cities.name as city_name')
            ->leftJoin('countries', 'leads.country', '=', 'countries.id')
            ->leftJoin('states', 'leads.state', '=', 'states.id')
            ->leftJoin('cities', 'leads.city', '=', 'cities.id')
            ->where('leads.id', $id)
            ->first();
        return view("Leadmanagement.Viewleaddata", compact("data"));
    }

    public function addLeadDocument(Request $request, $id)
    {
        
        $data = Leads::select('document_category.id as id','document_category.type as Type', 'document_category.name as documents')->where('leads.id',$id)->join('document_category',function($q){
            $q->on('document_category.subcategory','leads.type_of_immigration')->on('document_category.type','leads.interested');
        })->get();
        $uplodedDocs = Documents::where('leads_id', $id)->pluck('document', 'document_id')->toArray();
        return view("Leadmanagement.Leaddocument", compact("id", "data", "uplodedDocs"));
    }


    public function postAddDocuments(Request $request, $id)
    {
        $data = $request->except('_token');
        $data['user_id'] = Auth::id();
        $data['leads_id'] = $id;
        $data['status'] = '1';

        $file = $request->document->getClientOriginalName();

        $fileExtension = $request->document->getClientOriginalExtension();
        $randomstr = Str::random();

        $data['document_name'] = $request->document_name_hidden;
        $data['document'] = "Document_" . $randomstr . "." . $fileExtension;
        $file = $data["document"];
        $destinationPath = public_path('uploads/docs/');
        $filePath = $destinationPath . '/' . $file;
        $leaddata = Documents::where('leads_id', $id)->where('document_id', $data['document_id'])
            ->where("document_type", $request->document_type)->first();
        if ($leaddata) {
            return redirect()->back()->with("error", "Document already uploaded");
        }
        $check = Documents::create($data);
        if ($check) {
            if (!file_exists($filePath)) {
                $fileName = $file;
                $request->document->move($destinationPath, $fileName);
            }
            return redirect()->back()->with('success', 'Files uploaded successfuly');
        } else {
            return redirect()->back()->with('error', 'Files not uploaded');
        }
    }

    public function deleteDocs($leadid, $id)
    {
        $filename = Documents::where('leads_id', $leadid)->where('document_id', $id)->first();
        if ($filename != NULL) {
            $filePath = public_path('uploads/docs/' . $filename->document);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $filename->delete();
            return redirect()->back()->with('success', 'Deleted Successfully');
        }
        return redirect()->back()->with('error', 'Something Went Wrong');
    }

    public function followUp($id)
    {
        $data = Followup::where('lead_id', $id)->get();
        return view('Leadmanagement.Followup', compact('id', 'data'));
    }

    public function createFollowUp(Request $request, $id)
    {
        $data = $request->except("_token");
        $username = Auth::user()->username;
        $data["lead_id"] = $id;
        $data["added_by"] = $username;
        $serial = random_int(1, 10000);
        $data["serial_id"] = "SI" . $serial;
        $check = Followup::create($data);
        if ($check) {
            return redirect()->route('followup', ['id' => $id])->with("success", "Followup Created");
        } else {
            return redirect()->back()->with("error", "Follow up Not Created");
        }
    }

    public function deleteFollowUp($id)
    {
        $check = Followup::where("id", $id)->delete();
        if ($check) {
            return redirect()->back()->with("success", "Follow-up Deleted");
        } else {
            return redirect()->back()->with("error", "Something went Wrong");
        }
    }

    public function editfollowup(Request $request)
    {
        $data = $request->only("id", "next_followup", "notes");
        $check = Followup::where("id", $data['id'])->update($data);
        if ($check) {
            return redirect()->back()->with("success", "Follow up details changed");
        } else {
            return redirect()->back()->with("error", "Some Error occured");
        }
    }


    public function loadImmigrationType(Request $request)
    {
        $list = Common::immigration();
        if (isset($request->list_type)) {
            $type = strtolower($request->list_type);
            if (isset($list[$type])) {
                // dd($list[$type]);
                return $list[$type];
            } else {
                return json_encode([]);
            }
        } else if (isset($request->fields) && (isset($request->field_type))) {
            $fields = strtolower($request->fields);
            $field_type = strtolower($request->field_type);
            if (isset($list[$field_type][$fields])) {
                return $list[$field_type][$fields];
            } else {
                return json_encode([]);
            }
        }
    }

    public function deleteDocumentCategory($id){
        $deleteCategrory = DocumentCategory::where('id',$id)->first();
        if($deleteCategrory != NULL){
            $deleteCategrory->delete();
            return redirect()->back()->with('success','Deleted Successfully');
        }
        return redirect()->back()->with('error','Something Went Wrong');
    }

    public function bulkUploadsLeads(Request $request){

        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        try {
            Excel::import(new LeadsImports, request()->file('excel_file'));
            return redirect()->back()->with('success', 'Excel Uploaded Successfully 📤');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    public function documentNames(Request $request)
    {
        $sbcategory=$request->field_type;
        $type=$request->type_immigrant;
        $data=DB::table('document_category')->where('subcategory',$sbcategory)->where('type',$type)->pluck('name','id')->toArray();
        return $data;
       
    }

}