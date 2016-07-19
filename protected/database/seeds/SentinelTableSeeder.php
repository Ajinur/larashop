<?php

use Illuminate\Database\Seeder;

class SentinelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('role_users')->truncate();
        DB::table('roles')->truncate();
        DB::table('users')->truncate();
        DB::table('persistences')->truncate();
        DB::table('reminders')->truncate();
        DB::table('throttle')->truncate();
        DB::table('activations')->truncate();

        try {
        	$role = Sentinel::getRoleRepository()->createModel()->create(['id'   => 1,'name'  => 'Super Admin','slug'  => 'super-admin']);
            $user = Sentinel::register([
                    'id'    => 1,
                    'email' => 'superadmin@gmail.com',
                    'username' => 'superadmin',
                    'password'  => 'superadmin',
                    'first_name'    => 'Super',
                    'last_name'     => 'Admin',
                ], true);

            $role->users()->attach($user);

            $role = Sentinel::getRoleRepository()->createModel()->create(['id'   => 2,'name'  => 'Administrator','slug'  => 'administrator']);
            $user = Sentinel::register([
                    'id'    => 2,
                    'email' => 'admin@email.com',
                    'username' => 'admin',
                    'password'  => 'admin',
                    'first_name'    => 'Admin',
                    'last_name'     => 'Biasa',
                ], true);
            $role->users()->attach($user);

        } catch (Exception $e) {
        	print "Error Exception ";
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
