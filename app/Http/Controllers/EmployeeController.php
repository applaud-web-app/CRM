<?php

namespace App\Http\Controllers;

use App\Helpers\Common;
use App\Models\Activity;
use DataTables;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use function Laravel\Prompts\password;
use Google\Client;
// use Illuminate\Support\Facades\DB;
class EmployeeController extends Controller
{
    public function viewEmployee(Request $request)
    {
        if ($request->ajax()) {
            $start = ($request->start) ? $request->start : 0;
            $pageSize = ($request->length) ? $request->length : 50;
            $employee = User::withoutRole('Superadmin')->with('roles:name')->where('status', 1)->orderBy('id', 'DESC')->skip($start)->take($pageSize);
            $count_total = User::where('status', 1)->withoutRole('Superadmin')->count();
            return Datatables::of($employee)
                ->addIndexColumn()
                ->editColumn('created_at', function ($enquiry) {
                    return $enquiry->created_at->format('d-M-y');
                })
                ->editColumn('first_name', function ($enquiry) {
                    return $enquiry->first_name . ' ' . $enquiry->last_name;
                })
                ->editColumn('score', function ($score) {
                    $score = "30/50";
                    return $score;
                })
                ->editColumn('role', function ($role) {
                    $role = $role->roles[0]->name;
                    return $role;
                })
                ->addColumn('action', function ($row) {

                    $action = '<td>
                    <div class="d-flex">
                        <a href="' . route('editemployees', $row->id) . '" class="btn btn-primary  btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                        <a href="' . route('deleteemployees', $row->id) . '" class="btn btn-danger  btn-xs sharp delete"><i class="fa fa-trash"></i></a>
                    </div>												
                </td>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->setTotalRecords($count_total)
                ->make(true);
        }
        return view('employee.Employees');
    }

    public function deleteEployees($id)
    {
        $check = User::where('id', $id)->update(['status' => 0]);
        if ($check) {
            return redirect()->route('viewEmployee')->with('success', 'Employee deleted');
        } else {
            return redirect()->back()->with('error', 'Error Occured');
        }
    }

    public function editEmployees(Request $request, $id)
    {
        $data = User::where('id', $id)->first();
        $roles = Role::orderBy('name')->get();
        return view('employee.editemployee', compact('data','roles'));
    }

    public function updateEmployeeData(Request $request, $id)
    {
        $check = $request->validate([
            'first_name' => 'required',
            'joining_date'=>'required',
            'dob'=>'required',
            'gender'=> 'required',
            'address'=>'required',
            'phone' => 'required|numeric|digits:10',
            'email' => 'email|required',
            'username' => 'required',
        ]);

        $emailUnique = User::where('email', $request->email)->where('id', '!=', $id)->doesntExist();
        $usernameUnique = User::where('username', $request->username)->where('id', '!=', $id)->doesntExist();
        $phoneUnique = User::where('phone', $request->phone)->where('id', '!=', $id)->doesntExist();
        if(!$emailUnique){
            return redirect()->back()->with('error','Email already in use');
        }
        else if(!$usernameUnique){
            return redirect()->back()->with('error','username already in use');
        }
        else if(!$phoneUnique){
            return redirect()->back()->with('error','Mobile number already in use');
        }
        else {

            
            $data = ([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "email" => $request->email,
                "phone" => $request->phone,
                "username" => $request->username,
                "blood_group" => $request->blood_group,
                "joining_date" => $request->joining_date,
                "dob" => $request->dob,
                "address"=> $request->address,
            ]);

            if($request->hasfile('profile'))
            {
                $file = $request->file('profile');
                $imageName =  "EMP-".rand().".".$file->extension();
                $file->move(public_path('uploads/users/') , $imageName);  
                $data['profile_img']  = $imageName; 
            }

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }
            // if($request->filled('profile_img')){
            //     $data['profile_img'] = $request->profile_img;
            // }
            $check = User::where("id", $id)->update($data);
            if ($check) {
                return redirect()->route("viewEmployee")->with("success", "Employee Data Updated");
            } 
            else{
                return redirect()->back()->with("error", "Error Occured");
            }
        }
    }

    public function addEmployee()
    {   
        $roles = Role::orderBy('name')->get();
        return view("employee.AddEmployees",compact("roles"));
    }

    public function postAddEmployee(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'joining_date'=>'required',
            'dob'=>'required',
            'gender'=> 'required',
            'address'=>'required',
            'phone' => 'required|numeric|digits:10',
            'email' => 'email|required',
            'username' => 'required',
            'password'=>'required|min:8',
        ]);

        $empCode = "#".rand();
        $emailUnique = User::where('email', $request->email)->exists();
        $usernameUnique = User::where('username', $request->username)->exists();
        $phoneUnique = User::where('phone', $request->phone)->exists();
        if($emailUnique){
            return redirect()->back()->with('error','Email Already In Use');
        }
        else if($usernameUnique){
            return redirect()->back()->with('error','Username Already In Use');
        }
        else if($phoneUnique){
            return redirect()->back()->with('error','Mobile Number Already In Use');
        }
        else{

            $data= $request->except('_token','role');
            if($request->hasfile('profile'))
            {
                $file = $request->file('profile');
                $imageName =  "EMP-".rand().".".$file->extension();
                $file->move(public_path('uploads/users/') , $imageName);  
                $data['profile_img']  = $imageName; 
            }
            
            $data['emp_code'] = $empCode;
            $data['status'] = 1;
            $user = User::create($data);
            $role = Role::where('name', $request->role)->first();
            $user->assignRole($role);
            if ($user) {    
                return redirect()->route('viewEmployee')->with('success','Employee added');
            }
            else{
                return redirect()->back()->with('error', 'Error occured');
            }
        }
    }

}
