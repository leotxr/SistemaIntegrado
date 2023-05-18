<?php

namespace App\Http\Controllers\Policies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    public function store(Request $request)
    {


        $role = Role::create([
            'name' => $request->role_name,
        ]);

        if($role)
        return back()->with('status', 'role-stored');
    }


    public function set_permission(Request $request)
    {
        $store = DB::table('role_has_permissions')->insert([
            'permission_id' => $request->permission_id,
            'role_id' => $request->role_id
        ]);

        if($store)
        return back()->with('status', 'role-stored');
    }

}
