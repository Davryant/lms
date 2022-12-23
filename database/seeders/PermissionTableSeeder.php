<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'book-list',
            'book-create',
            'book-edit',
            'book-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'book-view',
            'book-like',
            'book-comment',
            'book-mark',
            'user-list',
            'user-create',
            'user-show',
            'user-edit',
            'user-delete'
         ];
       
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
