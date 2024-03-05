<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function allRole(){
        $allRole = Role::get();
        return view('role.view-role',compact('allRole'));
    }

    public function addRole(){
        return view('role.add-role');
    }

    public function storeRole(Request $request){
        $request->validate([
            'name'=>'required'
        ]);

        Role::create(['name' => $request->name, 'guard_name'=>'web']);
        return redirect()->back()->with('success','Role Added Successfully');
    }

    public function deleteRole($id){
        $role = Role::find($id);
        if($role != NULL){
            $role->delete();
            return redirect()->back()->with('success','Role Deleted Successfully');
        }
        return redirect()->back()->with('success','Something Went Wrong');
    }

    public function editRole(Request $request ,$id){
        $role = Role::find($id);
        if($role != NULL){
            return view('role.edit-role', compact('role'));
        }
        return redirect()->back()->with('success','Something Went Wrong');
    }

    public function updateRole(Request $request ,$id){
        $request->validate([
            'name'=>'required'
        ]);
        $role = Role::find($id);
        if($role != NULL){
            $role->name = $request->name;
            $role->save();
            return redirect(route('view.role'))->with('success','Role Updated Successfully');
        }
        return redirect()->back()->with('success','Something Went Wrong');
    }

    public function assignPermission(){
        $roles = Role::get();
        $permission = Permission::get();
        return view('role.assign',compact('roles','permission'));
    }

    public function storeAssignPermission(Request $request){
        $request->validate([
            'role'=>'required',
            'permission'=>'required',
        ]);
        $role = $request->role;
        $permission = $request->permission;
        $role->syncPermissions($permissions);
        return redirect()->back()->with('success','Permission Assigned Successfully');
    }
}
