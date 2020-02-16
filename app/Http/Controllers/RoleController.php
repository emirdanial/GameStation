<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {   
    	$roles = Role::all();
    	$permissions = Permission::all();

    	return view('admin.roles.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
    	$data = $request->validate([
    		'role' => 'required',
    		'check_list' => 'required'
    	]);

    	$input = $request['role'];

    	$role = Role::create(['name' => $input ]);

    	$permissions = $request->input('check_list');

    	foreach ($permissions as $value) {
    		$role->givePermissionTo($value);
    	}

    	return back();

    }

    public function destroy(Role $role)
    {
        $role->delete();

        return back();
    }
}
