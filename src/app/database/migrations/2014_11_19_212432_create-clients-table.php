<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->enum('state', array('Buyer', 'Seller'));
            $table->integer('prix_from')->nullable();
            $table->integer('prix_to')->nullable();
            $table->integer('loyer_from')->nullable();
            $table->integer('loyer_to')->nullable();
            $table->integer('surface_from')->nullable();
            $table->integer('surface_to')->nullable();

            $table->boolean('terrace');
            $table->boolean('extraction');
            $table->boolean('apartment');
            
            $table->boolean('licenseII');
            $table->boolean('licenseIII');
            $table->boolean('licenseIV');
            
            $table->integer('surface_sell_from')->nullable();
            $table->integer('surface_sell_to')->nullable();

            $table->string('lastname', 64)->nullable();
            $table->string('firstname', 64)->nullable();
            $table->string('phone', 24)->nullable();
            $table->string('mail', 60)->nullable();
            $table->dateTime('last_relance')->nullable();
            $table->dateTime('next_relance')->nullable();

            $table->string('company', 64)->nullable();
            $table->string('mandat', 16)->nullable();
            $table->string('address_number', 16)->nullable();
            $table->string('address_street', 128)->nullable();
            $table->string('address_zipcode', 16)->nullable();
            $table->string('address_city', 64)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clients');
    }

}
