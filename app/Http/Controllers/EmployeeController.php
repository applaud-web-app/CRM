<?php

namespace App\Http\Controllers;

use Exception;
use DataTables;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use function Laravel\Prompts\password;

// use Illuminate\Support\Facades\DB;
class EmployeeController extends Controller
{
    public function viewEmployee(Request $request)
    {
        if ($request->ajax()) {
            $start = ($request->start) ? $request->start : 0;
            $pageSize = ($request->length) ? $request->length : 50;
            $employee = User::withoutRole('Superadmin')->with('roles:name')->where('status', 1)->orderBy('id', 'DESC')->skip($start)->take($pageSize);

            $count_total = User::where('status', 1)
                ->withoutRole('Superadmin')->count();
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
                        <a href="' . route('deleteemployees', $row->id) . '" class="btn btn-danger  btn-xs sharp"><i class="fa fa-trash"></i></a>
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
            'last_name' => 'required',
            'email' => 'email|required',
            'phone' => 'required|numeric|digits:10',
            'username' => 'required',
            'emp_code' => 'required',
            'blood_group' => 'required',
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
                "emp_code" => $request->emp_code,
                "blood_group" => $request->blood_group,
                "joining_date" => $request->joining_date,
                "dob" => $request->dob,
                "department" => $request->department,
                "address"=> $request->address,
            ]);
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }
            if($request->filled('profile_img')){
                $data['profile_img'] = $request->profile_img;
            }
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
            'password'=>'required|min:8',
            'email' => 'email|required',
            'phone' => 'required|numeric|digits:10',
            'username' => 'required',
            'emp_code' => 'required',
            'blood_group' => 'required',
            'dob'=>'required',
            'department'=> 'required',
            'gender'=> 'required',
            'status'=> 'required',
        ]);

        $emailUnique = User::where('email', $request->email)->exists();
        $usernameUnique = User::where('username', $request->username)->exists();
        $phoneUnique = User::where('phone', $request->phone)->exists();
        if($emailUnique){
            return redirect()->route('viewEmployee')->with('error','Email already in use');
        }
        else if($usernameUnique){
            return redirect()->route('viewEmployee')->with('error','username already in use');
        }
        else if($phoneUnique){
            return redirect()->route('viewEmployee')->with('error','Mobile number already in use');
        }
        else{
            $data= $request->except('_token','role');
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
