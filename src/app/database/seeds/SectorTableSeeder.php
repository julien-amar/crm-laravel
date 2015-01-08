<?php

class SectorTableSeeder extends Seeder {

    public function run()
    {
        DB::table('sectors')->delete();

        Sector::create(array('label' => '75001'));
		Sector::create(array('label' => '75002'));
		Sector::create(array('label' => '75003'));
		Sector::create(array('label' => '75004'));
		Sector::create(array('label' => '75005'));
		Sector::create(array('label' => '75006'));
		Sector::create(array('label' => '75007'));
		Sector::create(array('label' => '75008'));
		Sector::create(array('label' => '75009'));
		Sector::create(array('label' => '75010'));
		Sector::create(array('label' => '75011'));
		Sector::create(array('label' => '75012'));
		Sector::create(array('label' => '75013'));
		Sector::create(array('label' => '75014'));
		Sector::create(array('label' => '75015'));
		Sector::create(array('label' => '75016'));
		Sector::create(array('label' => '75017'));
		Sector::create(array('label' => '75018'));
		Sector::create(array('label' => '75019'));
		Sector::create(array('label' => '75020'));
		Sector::create(array('label' => '77'));
		Sector::create(array('label' => '78'));
		Sector::create(array('label' => '91'));
		Sector::create(array('label' => '92'));
		Sector::create(array('label' => '93'));
		Sector::create(array('label' => '94'));
		Sector::create(array('label' => '95'));
		Sector::create(array('label' => 'France'));
		Sector::create(array('label' => 'Province'));
    }
}
