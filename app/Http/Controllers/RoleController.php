<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    public function viewRoles()
    {
        $roles = Role::with('permissions')->get();
        $role_permissions = [];
        foreach ($roles as $role) {
            $role_permissions[] = $role->permissions;
        }
        $permissions = Permission::select('name', 'id')->orderBy('id', 'ASC')->get();
        // dd($role_permissions);
        return view('roles.view', compact('roles', 'permissions', 'role_permissions'));
    }

    public function updateRole(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'target' => 'required',
            'deduction' => 'required',
            'permissions'=>'required'
        ]);
        if ($request->filled('permissions')) {
            // dd('not empty');
            // foreach($permissions as $permission)
            // {
            DB::table('role_has_permissions')
                ->where('role_id', $request->role)
                ->whereNotIn('permission_id', $request->permissions)
                ->delete();

            // Insert or update records for selected checkboxes
            foreach ($request->permissions as $permission) {
                DB::table('role_has_permissions')
                    ->updateOrInsert(
                        ['permission_id' => $permission, 'role_id' => $request->role],
                        ['permission_id' => $permission, 'role_id' => $request->role]
                    );
            }
            // }
        }
        // dd('empty');
        $role = Role::find($request->role);
        if ($role != NULL) {
            $role->target = $request->target;
            $role->deduction = $request->deduction;
            $role->save();
            return redirect(route('viewRoles'))->with('success', 'Role Updated Successfully');
        }
        return redirect()->back()->with('error', 'Something Went Wrong');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_has_permission', 'role_id', 'permission_id');
    }
}
