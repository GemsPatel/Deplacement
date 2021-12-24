<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeplacementsTable extends Migration {

	public function up()
	{
		Schema::create('deplacements', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->dateTime('depart');
			$table->dateTime('departAccorde')->nullable();
			$table->dateTime('arrivee');
			$table->dateTime('arriveeAccorde')->nullable();
			$table->longText('mission');
			$table->longText('reference');
			$table->bigInteger('sous_liste_id')->unsigned();
			$table->integer('statut_id')->unsigned();
			$table->string('cne');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('deplacements');
	}
}
