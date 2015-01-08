<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
        	'login' => 'admin',
        	'password' => '$2y$10$zsrlg.3JEykG4IyzfUrdj.c19JtUjdd88zcFou7Gn8nZkGgomPGHm',
        	'fullname' => 'Administrator',
        	'phone' => '00112233',
        	'address' => 'address',
        	'admin' => '1',
        	'lock' => '0'
    	));

		User::create(array(
			'login' => 'user',
			'password' => '$2y$10$zsrlg.3JEykG4IyzfUrdj.c19JtUjdd88zcFou7Gn8nZkGgomPGHm',
			'fullname' => 'User',
			'phone' => '00112233',
			'address' => 'address',
			'admin' => '0',
			'lock' => '0'
		));

        User::create(array(
        	'login' => 'locked',
        	'password' => '$2y$10$zsrlg.3JEykG4IyzfUrdj.c19JtUjdd88zcFou7Gn8nZkGgomPGHm',
        	'fullname' => 'Locked User',
        	'phone' => '00112233',
        	'address' => 'address',
        	'admin' => '0',
        	'lock' => '1'
    	));
    }
}
