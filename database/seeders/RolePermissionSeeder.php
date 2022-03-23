<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create role
        $roleSuperAdmin = Role::create(['name' => 'Super Admin']);
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleManager = Role::create(['name' => 'Manager']);
        $roleExecutive = Role::create(['name' => 'Executive']);
        $roleGeneralUser = Role::create(['name' => 'General user']);

        //create permissions
        $permission = Permission::create(['name' => 'edit articles']);
        $permissions=[

            'dashboard.view',

            'banner.create',
            'banner.store',
            'banner.edit',
            'banner.delete',
            'banner.view',

            'user.create',
            'user.view',
            'user.edit',
            'user.store',
            'user.delete',

            
            'service.create',
            'service.view',
            'service.edit',
            'service.store',
            'service.delete',

            
            'product.create',
            'product.view',
            'product.edit',
            'product.store',
            'product.delete',

            
            'content.create',
            'content.view',
            'content.edit',
            'content.store',
            'content.delete',


            'rolePermission.view',
            'rolePermission.store',
            'rolePermission.delete',
            'rolePermission.create',
            'rolePermission.edit',

            
            'blog.create',
            'blog.view',
            'blog.edit',
            'blog.store',
            'blog.delete',

            
           
            'setting.view',
            'setting.edit',
            'setting.update',
            'setting.delete',
        ];

        //create permissions
        for($i=0;$i < count($permissions);$i++){
            $permission = Permission::create(['name' =>  $permissions[$i]]);
            $roleSuperAdmin->givePermissionTo($permission);
            $permission->assignRole($roleSuperAdmin);
        }
    }
}
