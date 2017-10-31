<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'Admin')->first();
	    $role_candidate  = Role::where('name', 'Candidate')->first();
	    $employee = new User();
	    $employee->name = 'Admin User';
	    $employee->email = 'admin@devilshunt.com';
	    $employee->password = bcrypt('secret');
	    $employee->save();
	    $employee->roles()->attach($role_admin);
	    $manager = new User();
	    $manager->name = 'Candidate Name';
	    $manager->email = 'candidate@devilshunt.com';
	    $manager->password = bcrypt('secret');
	    $manager->save();
	    $manager->roles()->attach($role_candidate);
    }
}
