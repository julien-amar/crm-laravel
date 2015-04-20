<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailings', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->string('operation', 64);
            $table->string('subject', 1024);
            $table->text('message');
            $table->enum('state', array('Todo', 'InProgress', 'Success', 'Error'));
            $table->string('reference', 32);
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
        Schema::drop('mailings');
    }

}
