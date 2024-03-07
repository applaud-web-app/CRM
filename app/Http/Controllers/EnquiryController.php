<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Enquiry;
use App\Models\Leads;
use Illuminate\Http\Request;
use App\Imports\BulkEnquiry;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Excel;

class EnquiryController extends Controller
{
    public function loadenquiry(Request $request)
    {

        if ($request->ajax()) {
            $start = ($request->start) ? $request->start : 0;
            $pageSize = ($request->length) ? $request->length : 50;
            $enquiries = Enquiry::where('status', 1)->skip($start)->take($pageSize);     
            $count_total= Enquiry::where('status', 1)->count();     
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
                          data-name="'.$row->name.'"
                          data-mobile="'.$row->mobile.'"
                          data-email="'.$row->email.'"
                          data-select="'.$row->interested.'" 
                          data-source="'.$row->source.'"
                          data-immigration="'.$row->type_of_immigration.'"
                          data-id="'.$row->id.'"
                          class="btn btn-primary mb-3"><i class="far fa-edit edit-btn "></i> Edit</a>
                          <a class="dropdown-item" href="'.route('deleteenquiry',$row->id).'"><i class="fas fa-trash-alt"></i> Delete</a>
                         
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item text-secondary" href="'.route('convertenquiry',$row->id).'"><i class="far fa-check-square"></i> Convert To Lead</a>
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

    public function saveenquiry(Request $request)
    {
        $data = $request->all();
        $type_of_immigration = "";
        if ($request->interested === "VISA") {
            $type_of_immigration = $request->type_of_visa;
            unset($data['type_of_iets']);
            unset($data['type_of_pte']);
        } elseif ($request->interested === "IETS") {
            $type_of_immigration = $request->type_of_iets;
            unset($data['type_of_visa']);
            unset($data['type_of_pte']);
        } elseif ($request->interested === "PTE") {
            $type_of_immigration = $request->type_of_pte;
            unset($data['type_of_visa']);
            unset($data['type_of_iets']);
        }
        $data['type_of_immigration'] = $type_of_immigration;
        $enquiry = Enquiry::create($data);
        if ($enquiry) {
            return redirect()->route("enquiry")->with("success", "Enquiry Created !");
        } else {
            return redirect()->route("enquiry")->with("error", "Enquiry could not be created !");
        }
    }

    public function editenquiry(Request $request)
    {
        $data= $request->except("id","_token");
        $id=$request->id;
        $type_of_immigration = "";
        if ($request->interested === "VISA") {
            $type_of_immigration = $request->type_of_visa;
            unset($data['type_of_visa']);
            unset($data['type_of_pte']);
            unset($data['type_of_iets']);
        } elseif ($request->interested === "IETS") {
            $type_of_immigration = $request->type_of_iets;
            unset($data['type_of_visa']);
            unset($data['type_of_pte']);
            unset($data['type_of_iets']);
        } elseif ($request->interested === "PTE") {
            $type_of_immigration = $request->type_of_pte;
            unset($data['type_of_visa']);
            unset($data['type_of_iets']);
            unset($data['type_of_pte']);
        }
        $data['type_of_immigration'] = $type_of_immigration;
        $check=Enquiry::where('id', $id)->update($data);
        if( $check ) {  
            return redirect()->route('enquiry')->with('success','Enquiry Updated');
        }
        else
        {
            return redirect()->route('enquiry')->with('error','Error Occured');
        }
        
    }

    public function deleteenquiry(Request $request, $id)
    {
        $check=Enquiry::where("id", $id)->update(["status"=> 0]);
        if( $check ) {
            return redirect()->route("enquiry")->with("success","Enquiry Deleted");
        } else {
            return redirect()->route("enquiry")->with("error", "Error occured while deleting");
        }
    }

    public function bulkUploadEnquiry(Request $request){
        $request->validate([
            'excel_file'=>'required|mimes:xls,xlsx'
        ]);

       Excel::import(new BulkEnquiry , request()->file('excel_file'));
       return redirect()->back()->with('success','Excel Uploaded Successfully 📤');
   }


    public function covertToLead(Request $request,$id)
    {    
        $data=Enquiry::find($id);
        $users = User::withoutRole('Admin')->orderBy('id','DESC')->where('status',1)->get();
        return view('Leadmanagement.ConvertEnquiry',compact('data','users'));
    }

    public function leadGenerate(Request $request,$id)
    {
        $data=$request->except("_token","source");
        $id= \Auth::id();
        $data["lead_mode"]="converted";
        $data["assigned_by"]=$id;
        $check=Leads::create($data);
        if( $check ) {
            return redirect()->route("/leads")->with("success","");
        } else {
            return redirect()->back()->with("error","Failed to convert to lead");
        }

    }

    public function loadLeads(Request $request)
    {
        $leads=Leads::with('employee')->get();
        // dd($leads);
        return view('Leadmanagement.Leads',compact('leads'));    
    }
}
