<?php

class MailingTableSeeder extends Seeder {

    public function run()
    {
        DB::table('mailings')->delete();

		Mailing::create(array(
			'client_id' => '1',
			'message' => 'Petit message',
			'state' => 'Todo'
		));
    }
}
