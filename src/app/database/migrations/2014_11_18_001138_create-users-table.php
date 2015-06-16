<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('login', 128)->unique();
            $table->string('password', 128);
            $table->string('fullname', 255);
            $table->string('phone', 15)->nullable();
            $table->string('address', 255)->nullable();
            $table->boolean('admin');
            $table->boolean('lock');
            $table->string('email', 128)->nullable();
            $table->dateTime('last_authentication')->nullable();
            $table->rememberToken();
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
        Schema::drop('users');
    }

}
