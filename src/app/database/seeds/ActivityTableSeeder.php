<?php

class ActivityTableSeeder extends Seeder {

    public function run()
    {
        DB::table('activities')->delete();

        Activity::create(array('label' => 'Bar'));
        Activity::create(array('label' => 'Hotel'));
    }
}
