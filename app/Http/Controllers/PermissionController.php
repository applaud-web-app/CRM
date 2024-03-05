<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function allPermission(){
        $allPermission = Permission::get();
        return view('permission.view-permission',compact('allPermission'));
    }

    public function addPermission(){
        return view('permission.add-permission');
    }

    public function storePermission(Request $request){
        $request->validate([
            'name'=>'required'
        ]);

        Permission::create(['name' => $request->name, 'guard_name'=>'web']);
        return redirect()->back()->with('success','Permission Added Successfully');
    }

    public function deletePermisssion($id){
        $permission = Permission::find($id);
        if($permission != NULL){
            $permission->delete();
            return redirect()->back()->with('success','Permission Deleted Successfully');
        }
        return redirect()->back()->with('success','Something Went Wrong');
    }

    public function editPermission(Request $request ,$id){
        $permission = Permission::find($id);
        if($permission != NULL){
            return view('permission.edit-permission', compact('permission'));
        }
        return redirect()->back()->with('success','Something Went Wrong');
    }

    public function updatePermission(Request $request ,$id){
        $request->validate([
            'name'=>'required'
        ]);
        $permission = Permission::find($id);
        if($permission != NULL){
            $permission->name = $request->name;
            $permission->save();
            return redirect(route('view.permission'))->with('success','Permission Updated Successfully');
        }
        return redirect()->back()->with('success','Something Went Wrong');
    }

}
