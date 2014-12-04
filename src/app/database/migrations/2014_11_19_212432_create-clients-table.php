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
                        $table->increments('id');
                        $table->integer('user_id');
                        $table->enum('prix', array('0 - 10', '11 - 20'));
                        $table->enum('loyer', array('10-100', '101 - 200'));
                        $table->enum('surface', array('0 - 10', '11 - 20'));
                        $table->string('lastname', 64)->nullable();
                        $table->string('firstname', 64)->nullable();
                        $table->string('company', 64)->nullable();
                        $table->string('activity', 50)->nullable();
                        $table->string('phone', 16)->nullable();
                        $table->string('mail', 60)->nullable();
                        $table->dateTime('birthday')->nullable();
                        $table->dateTime('last_relance')->nullable();
                        $table->dateTime('next_relance')->nullable();
                        $table->enum('state', array('Actif', 'Passif'));
                        $table->string('address_number', 16)->nullable();
                        $table->string('address_street', 128)->nullable();
                        $table->string('address_zipcode', 16)->nullable();
                        $table->string('address_city', 64)->nullable();
                        $table->text('comment');
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
