<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
{
    public function viewEmployee(){
        $employee = User::withoutRole('admin')->where('status',1)->orderBy('id','DESC')->get();
        return view('employee.view');
    }
}
