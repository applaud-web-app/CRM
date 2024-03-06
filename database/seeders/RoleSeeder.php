<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = Permission::get();
        Role::create([
            'name' => 'admin',
            'guard_name'=>'web'
        ])->syncPermissions($permissions);

        Role::create([
            'name' => 'Counsellor',
            'guard_name'=>'web',
            'target'=>'10'
        ]);
        Role::create([
            'name' => 'Filler',
            'guard_name'=>'web',
            'target'=>'15'
        ]);
        Role::create([
            'name' => 'Manager',
            'guard_name'=>'web',
            'target'=>'40'
        ]);
        Role::create([
            'name' => 'Telecaller',
            'guard_name'=>'web',
            'target'=>'35'
        ]);

    }
}
