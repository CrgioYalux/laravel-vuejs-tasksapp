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
        // create roles
        $role_super_admin = Role::create(['name' => 'super admin']);
        $role_employee = Role::create(['name' => 'employee']);

        // create permissions
        $permission_create_user = Permission::create(['name' => 'create users']);
        $permission_delete_user = Permission::create(['name' => 'delete users']);

        $permission_create_role = Permission::create(['name' => 'create roles']);
        $permission_read_role = Permission::create(['name' => 'read roles']);
        $permission_update_role = Permission::create(['name' => 'update roles']);
        $permission_delete_role = Permission::create(['name' => 'delete roles']);

        $permission_create_task = Permission::create(['name' => 'create tasks']);
        $permission_read_task = Permission::create(['name' => 'read tasks']);
        $permission_update_task = Permission::create(['name' => 'update tasks']);
        $permission_delete_task = Permission::create(['name' => 'delete tasks']);

        $permission_create_status = Permission::create(['name' => 'create statuses']);
        $permission_read_status = Permission::create(['name' => 'read statuses']);
        $permission_update_status = Permission::create(['name' => 'update statuses']);
        $permission_delete_status = Permission::create(['name' => 'delete statuses']);

        $permission_task_update_status = Permission::create(['name' => 'update tasks statuses']);
        $permission_task_read_status = Permission::create(['name' => 'read tasks statuses']);

        $permission_create_post = Permission::create(['name' => 'create posts']);
        $permission_comment_post = Permission::create(['name' => 'comment posts']);
        $permission_update_post = Permission::create(['name' => 'update posts']);
        $permission_delete_post = Permission::create(['name' => 'delete posts']);

        // assing permissions to roles
        $permissions_super_admin = [
            $permission_create_user,
            $permission_delete_user,

            $permission_create_role,
            $permission_read_role,
            $permission_update_role,
            $permission_delete_role,

            $permission_create_task,
            $permission_read_task,
            $permission_update_task,
            $permission_delete_task,

            $permission_create_status,
            $permission_read_status,
            $permission_update_status,
            $permission_delete_status,

            $permission_task_update_status,
            $permission_task_read_status,

            $permission_create_post,
            $permission_comment_post,
            $permission_update_post,
            $permission_delete_post
        ];

        $permissions_employee = [
            $permission_task_update_status,
            $permission_task_read_status,

            $permission_create_post,
            $permission_comment_post,
            $permission_update_post,
            $permission_delete_post
        ];

        // sync permissions to roles
        $role_super_admin->syncPermissions($permissions_super_admin);
        $role_employee->syncPermissions($permissions_employee);
    }
}
