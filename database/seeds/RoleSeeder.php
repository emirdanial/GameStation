<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	//create role
    	$Sadmin = User::create([
    		'id' => '1',
    		'name' => 'Superadmin',
    		'email' => 'admin@admin.com',
    		'password' => Hash::make('qweasdzxc'),
    	]);

        $roleData = array(
		    array(
		    	'id' => 1,
	            'name' => 'Superadmin',
	            'guard_name' => 'web',
		    ),
		    array(
		    	'id' => 2,
		    	'name' => 'Staff',
		        'guard_name' => 'web', 
		    ),
		    array(
		    	'id' => 3,
		    	'name' => 'Customer',
		        'guard_name' => 'web', 
		    ),
		);

		foreach ($roleData as $r) {
        	Role::create($r);
        }

        // create permission

        $permissionData = array(
	        array(
	        	'id' => 1,
	        	'name' => 'manage user',
	            'guard_name' => 'web', 
	        ),
	        array(
	        	'id' => 2,
	        	'name' => 'manage product',
	            'guard_name' => 'web', 
	        ),
	        array(
	        	'id' => 3,
	        	'name' => 'manage order',
	            'guard_name' => 'web', 
	        ),
	        array(
	        	'id' => 4,
	        	'name' => 'manage profile',
	            'guard_name' => 'web', 
	        ),
	        array(
	        	'id' => 5,
	        	'name' => 'manage cart',
	            'guard_name' => 'web', 
	        ),
    	); 

        foreach ($permissionData as $p) {
        	Permission::create($p);
        }


        // assign role to permission

        $admin = Role::find(1);

        for ($i=1; $i<6 ; $i++) { 
        	$admin->givePermissionTo($i);
        }

        $Sadmin->assignRole(1);

        $staff = Role::find(2);

        for ($i=2; $i<5 ; $i++) { 
        	$staff->givePermissionTo($i);
        }

        $customer = Role::find(3);

        for ($i=4; $i<6 ; $i++) { 
        	$customer->givePermissionTo($i);
        }

    }
}
