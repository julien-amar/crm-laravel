<?php

class HistoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('histories')->delete();

        History::create(array(
            'client_id' => '1',
            'message' => 'Petit message'
        ));
    }
}
