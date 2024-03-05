<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission1 = Permission::create(['name' => 'dashboard','guard_name'=>'web']);
        $permission2 = Permission::create(['name' => 'view_enquiry','guard_name'=>'web']);
        $permission3 = Permission::create(['name' => 'create_enquiry','guard_name'=>'web']);
        $permission3 = Permission::create(['name' => 'edit_enquiry','guard_name'=>'web']);
        $permission3 = Permission::create(['name' => 'delete_enquiry','guard_name'=>'web']);
    }
}
