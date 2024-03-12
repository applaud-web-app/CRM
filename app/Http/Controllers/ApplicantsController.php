<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leads;
use Yajra\DataTables\Facades\DataTables;

class ApplicantsController extends Controller
{
    // public function showAppliance(Request $request)
    // {

    // }
    public function allApplicants(Request $request) 
    {
        if( $request->ajax() )
        {
            $start = ($request->start) ? $request->start : 0;
            $pageSize = ($request->length) ? $request->length : 50;
            $leads = Leads::where("is_deleted",1)
            ->where("proccess_status", 0)
            ->with('employee')->orderBy('id', 'DESC')->skip($start)->take($pageSize);     
            $count_total= Leads::where('is_deleted', 1)->where('proccess_status',0)->count();     
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
                          <a class="dropdown-item" href="'.route('viewapplicant',$row->id).'"><i class="far fa-eye"></i> View Lead</a>  
                    
                          <a class="dropdown-item" href="javascript:void(0);"><i class="fas fa-check"></i> Accept Lead</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i class="fas fa-trash-alt"></i> Reject Lead</a>
                       
                       
                       </div>
                    </div>
                 </div>';
                    return $dropdown;
                })
                ->rawColumns(['action'])
                ->setTotalRecords($count_total)
                ->make(true);
        }
        else
        {   
            return view("applicants.Allapplicants");
        }
    }

    public function viewApplicantData(Request $request,$id)
    {
        $data = Leads::select('leads.*', 'countries.name as country_name', 'states.name as state_name', 'cities.name as city_name')
            ->leftJoin('countries', 'leads.country', '=', 'countries.id')
            ->leftJoin('states', 'leads.state', '=', 'states.id')
            ->leftJoin('cities', 'leads.city', '=', 'cities.id')
            ->where('leads.id', $id)
            ->first();

        // dd($data);
        return view("applicants.Viewdata",compact("data"));
        
    }

}
