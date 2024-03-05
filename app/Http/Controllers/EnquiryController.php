<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;

// use Yajra\DataTables\Contracts\DataTable;

class EnquiryController extends Controller
{
    public function loadenquiry(Request $request)
    {

        if ($request->ajax()) {
            $enquiries = Enquiry::query();
            return Datatables::of($enquiries)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $dropdown = ' <div class="dropdown text-sans-serif">
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
                       <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-eye"></i> View</a>  
                          <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-edit"></i> Edit</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i class="fas fa-trash-alt"></i> Delete</a>
                         
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item text-secondary" href="convert-to-lead.php"><i class="far fa-check-square"></i> Convert To Lead</a>
                       </div>
                    </div>';
                    return $dropdown;
                })
                ->rawColumns(['action'])
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
}
