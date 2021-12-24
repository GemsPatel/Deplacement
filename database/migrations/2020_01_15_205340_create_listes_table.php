<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListesTable extends Migration {

	public function up()
	{
		Schema::create('listes', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('numero');
			$table->date('date');
			$table->integer('organe_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('listes');
	}
}
