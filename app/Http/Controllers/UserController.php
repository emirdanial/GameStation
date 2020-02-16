<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;

class UserController extends Controller
{
	public function index()
	{	
		$users = User::all();
		$roles = Role::all();

		return view('admin.users.index', compact('users', 'roles'));
	}

	public function create()
	{	
		$roles = Role::all();

		return view('admin.users.create', compact('roles'));
	}

	public function store(Request $request)
	{
		$data = $request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'password' => 'required'
		]);

		$user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

		$role = $request['role'];
		$user->assignRole($role);

		return redirect()->route('admin.users.index');

	}

	public function edit(User $user)
	{
		//$user_p = $user->getAllPermissions()->pluck('id')->toArray(); pluck user permission id

		$permissions = Permission::all();

		return view('admin.users.edit', compact('user', 'permissions'));
	}

	public function update(Request $request, User $user)
	{	

		$data = $request->validate([
			'name' => 'required',
			'email'=>'required',
		]);

		$permissions = $request->input('check_list');

		$user->syncPermissions($permissions);

    	$user->update($data);

		return redirect()->route('admin.users.index');

	}


	public function destroy(User $user)
	{
		$user->delete();

		return back();
	}
    
}
