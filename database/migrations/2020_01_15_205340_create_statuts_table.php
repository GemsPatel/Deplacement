<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatutsTable extends Migration {

	public function up()
	{
		Schema::create('statuts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('statut');
			$table->string('slug');
		});
	}

	public function down()
	{
		Schema::drop('statuts');
	}
}