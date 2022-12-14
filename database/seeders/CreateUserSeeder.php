<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Normal User']);
        $permission_array = [1,9,10,11,12];
        $permissions = Permission::wherein('id',$permission_array)->pluck('id','id');
     
        $role->syncPermissions($permissions);
    }
}
