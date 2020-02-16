<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

	public function index()
	{
		$permissions = Permission::all();

		return view('admin.permissions.index', compact('permissions'));
	}

    public function store(Request $request)
    {
    	$data = $request->validate([
    		'name' => 'required'
    	]);

    	Permission::create($data);

    	return back();
    }

    public function destroy(Permission $permission)
    {
    	$permission->delete();

    	return back();

    }
}
