<?php

class MailingTableSeeder extends Seeder {

    public function run()
    {
        DB::table('mailings')->delete();

		Mailing::create(array(
			'user_id' => '1',
			'client_id' => '1',
			'operation' => 'BaissePrix',
			'subject' => 'sujet',
			'message' => 'Petit message',
			'state' => 'Todo',
			'reference' => 'REF5H4FD420SZ'
		));
    }
}
