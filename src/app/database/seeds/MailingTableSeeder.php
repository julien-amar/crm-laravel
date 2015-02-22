<?php

class MailingTableSeeder extends Seeder {

    public function run()
    {
        DB::table('mailings')->delete();

		Mailing::create(array(
			'user_id' => '1',
			'client_id' => '1',
			'message' => 'Petit message',
			'state' => 'Todo'
		));
    }
}
