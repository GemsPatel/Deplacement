<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('deplacements', function(Blueprint $table) {
			$table->foreign('statut_id')->references('id')->on('statuts')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('deplacements', function(Blueprint $table) {
			$table->foreign('sous_liste_id')->references('id')->on('sous_listes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('deplacements', function(Blueprint $table) {
			$table->foreign('cne')->references('cne')->on('militaires')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('militaires', function(Blueprint $table) {
			$table->foreign('grade_id')->references('id')->on('grades')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('grades', function(Blueprint $table) {
			$table->foreign('categorie_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('listes', function(Blueprint $table) {
			$table->foreign('organe_id')->references('id')->on('organes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('organes', function(Blueprint $table) {
			$table->foreign('inspection_id')->references('id')->on('organes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('deplacements', function(Blueprint $table) {
			$table->dropForeign('deplacements_statut_id_foreign');
		});
		Schema::table('deplacements', function(Blueprint $table) {
			$table->dropForeign('deplacements_militaire_id_foreign');
		});
		Schema::table('militaires', function(Blueprint $table) {
			$table->dropForeign('militaires_grade_id_foreign');
		});
		Schema::table('grades', function(Blueprint $table) {
			$table->dropForeign('grades_categorie_id_foreign');
		});
		Schema::table('listes', function(Blueprint $table) {
			$table->dropForeign('listes_organe_id_foreign');
		});
		Schema::table('organes', function(Blueprint $table) {
			$table->dropForeign('organes_inspection_id_foreign');
		});
	}
}
