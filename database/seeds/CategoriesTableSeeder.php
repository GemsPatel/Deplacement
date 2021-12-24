<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->insert([
        'categorie' => 'Officier général',
        'slug' => 'officier-general',
      ]);
      DB::table('categories')->insert([
        'categorie' => 'Officier',
        'slug' => 'officier',
      ]);
      DB::table('categories')->insert([
        'categorie' => 'Sous officier',
        'slug' => 'sous-officier',
      ]);
      DB::table('categories')->insert([
        'categorie' => 'Militaire de rang',
        'slug' => 'mdr',
      ]);
    }
}
