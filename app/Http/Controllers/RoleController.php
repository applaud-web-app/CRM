<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    public function viewRoles(){
        $roles = Role::with('permissions')->get();
        return view('roles.view',compact('roles'));
    }
    
    public function updateRole(Request $request){
        $request->validate([
            'role'=>'required',
            'target'=>'required',
            'deduction'=>'required',
        ]);
        $role = Role::find($request->role);
        if($role != NULL){
            $role->target = $request->target;
            $role->deduction = $request->deduction;
            $role->save();
            return redirect(route('viewRoles'))->with('success','Role Updated Successfully');
        }
        return redirect()->back()->with('error','Something Went Wrong');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_has_permission', 'role_id', 'permission_id');
    }
}
