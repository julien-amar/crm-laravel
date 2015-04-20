<?php

class HistoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('histories')->delete();

        History::create(array(
            'user_id' => '1',
            'client_id' => '1',
            'message' => 'Petit message'
        ));
    }
}
