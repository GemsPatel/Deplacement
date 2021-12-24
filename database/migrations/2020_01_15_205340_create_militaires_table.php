<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMilitairesTable extends Migration {

	public function up()
	{
		Schema::create('militaires', function(Blueprint $table) {
			$table->string('nom');
			$table->string('prenom');
			$table->boolean('marie');
			$table->string('cne')->primary();
			$table->string('matricule');
			$table->integer('grade_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('militaires');
	}
}
