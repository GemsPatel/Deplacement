<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('statuts')->insert([
        'statut' => 'En instance',
        'slug' => 'en-instance',
      ]);

      DB::table('statuts')->insert([
        'statut' => 'Rejetée',
        'slug' => 'rejetee',
      ]);

      DB::table('statuts')->insert([
        'statut' => 'Absence Temporaire',
        'slug' => 'absence-temporaire',
      ]);

      DB::table('statuts')->insert([
        'statut' => 'Journalière',
        'slug' => 'journaliere',
      ]);

      DB::table('statuts')->insert([
        'statut' => 'Exceptionelle',
        'slug' => 'exceptionnelle',
      ]);
    }
}
