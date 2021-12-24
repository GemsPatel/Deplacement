<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSousListesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sous_listes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('liste_id')->unsigned();
            $table->integer('statut_id')->unsigned();
            $table->timestamps();

            $table->foreign('liste_id')->references('id')->on('listes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('statut_id')->references('id')->on('statuts')
                  ->onDelete('no action')
                  ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sous_listes');
    }
}
