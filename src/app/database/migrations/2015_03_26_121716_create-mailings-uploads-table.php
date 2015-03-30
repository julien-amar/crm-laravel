<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailingsUploadsTable extends Migration {

   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailings_uploads', function($table) {
            $table->increments('id')->unsigned();
            $table->integer('mailing_id')->unsigned();
            $table->integer('upload_id')->unsigned();
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
        Schema::drop('mailings_uploads');
    }

}
