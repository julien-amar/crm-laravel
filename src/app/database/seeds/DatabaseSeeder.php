<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('ClientTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('SectorTableSeeder');
		$this->call('ActivityTableSeeder');
		$this->call('MailingTableSeeder');
		$this->call('HistoryTableSeeder');
	}
}
