<?php
namespace App\Traits;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


trait spatieTrait
{
    public function getOrCreateNewRole($role)
    {
        try {
            $a_role = Role::findByName($role);
        } catch (Exception $e) {
            $a_role = Role::create(['name' => $role]);
        }
        return $a_role;
    }

    public function getOrCreateNewPermission($permission)
    {
        try {
            $a_permission = Permission::create(['name' => $permission]);
        } catch (Exception $e) {
            $a_permission = $permission;
        }
        return $a_permission;
    }




}
