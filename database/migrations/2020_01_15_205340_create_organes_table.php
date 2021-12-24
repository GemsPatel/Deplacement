<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganesTable extends Migration {

	public function up()
	{
		Schema::create('organes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('organe');
			$table->integer('inspection_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('organes');
	}
}