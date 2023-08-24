<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function roles()
    {
        $customer = Role::create(['name' => 'customer']);
        $employee = Role::create(['name' => 'employee']);

        $create = Permission::create(['name' => 'create']);
        $edit = Permission::create(['name' => 'edit']);
        $show = Permission::create(['name' => 'show']);
        $list = Permission::create(['name' => 'list']);
        $customer->givePermissionTo($show);
        $customer->givePermissionTo($list);

        $employee->givePermissionTo($create);
        $employee->givePermissionTo($edit);
        $employee->givePermissionTo($show);
        $employee->givePermissionTo($list);

        return 'ok';
    }
}
