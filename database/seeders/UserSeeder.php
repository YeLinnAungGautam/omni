<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'factory_name' => 'Z Trade',
            'password' => bcrypt('admin'),
            'profile_pic'=>"12312.jpg"
        ]);

        $role = Role::create(['name' => 'Admin','guard_name'=>'api']);
        //clear
        //$role = Role::create(['name' => 'User','guard_name'=>'nonrole']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
        $role = Role::create(['name' => 'User','guard_name'=>'nonrole']);

    }
}
