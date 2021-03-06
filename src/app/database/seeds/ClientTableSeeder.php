<?php

class ClientTableSeeder extends Seeder {

    public function run()
    {
        DB::table('clients')->delete();

        Client::create(array(
            'user_id' => '1',
            'prix_from' => '10',
            'prix_to' => '20',
            'loyer_from' => '30',
            'loyer_to' => '40',
            'surface_from' => '50',
            'surface_to' => '60',
            'surface_sell_from' => '70',
            'surface_sell_to' => '80',
            'terrace' => '1',
            'extraction' => '1',
            'apartment' => '1',
            'licenseII' => '1',
            'licenseIII' => '1',
            'licenseIV' => '1',
            'lastname' => 'Seed',
            'firstname' => 'User',
            'phone' => '0123456789',
            'mail' => 'xxx@xxx.xxx',
            'last_relance' => '2014-10-10 10:10:10',
            'next_relance' => '2015-10-10 10:10:10',
            'state' => 'ActiveBuyer',
            'company' => 'IBM',
            'mandat'  => '2C574FR256CN',
            'address_number' => '10',
            'address_street' => 'rue de la soif',
            'address_zipcode' => '75000',
            'address_city' => 'Paris'
        ));
    }
}
