<?php

use App\Categorie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('grades')->insert([
        'grade' => '2°classe',
        'slug' => '2classe',
        'categorie_id' => Categorie::where('slug', 'mdr')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => '1°classe',
        'slug' => '1classe',
        'categorie_id' => Categorie::where('slug', 'mdr')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'caporal',
        'slug' => 'caporal',
        'categorie_id' => Categorie::where('slug', 'mdr')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Caporal chef',
        'slug' => 'caporal-chef',
        'categorie_id' => Categorie::where('slug', 'mdr')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Sergent',
        'slug' => 'sergent',
        'categorie_id' => Categorie::where('slug', 'sous-officier')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Sergent Chef',
        'slug' => 'sergent-chef',
        'categorie_id' => Categorie::where('slug', 'sous-officier')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Sergent Major',
        'slug' => 'sergent-major',
        'categorie_id' => Categorie::where('slug', 'sous-officier')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Adjudant',
        'slug' => 'adjudant',
        'categorie_id' => Categorie::where('slug', 'sous-officier')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Adjudant Chef',
        'slug' => 'adjudant-chef',
        'categorie_id' => Categorie::where('slug', 'sous-officier')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Sous Lieutenant',
        'slug' => 'sous-lieutenant',
        'categorie_id' => Categorie::where('slug', 'officier')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Lieutenant',
        'slug' => 'lieutenant',
        'categorie_id' => Categorie::where('slug', 'officier')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Capitaine',
        'slug' => 'capitaine',
        'categorie_id' => Categorie::where('slug', 'officier')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Commandant',
        'slug' => 'commandant',
        'categorie_id' => Categorie::where('slug', 'officier')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Lieutenant Colonel',
        'slug' => 'lieutenant-colonel',
        'categorie_id' => Categorie::where('slug', 'officier')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Colonel',
        'slug' => 'colonel',
        'categorie_id' => Categorie::where('slug', 'officier')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Colonel Major',
        'slug' => 'colonel-major',
        'categorie_id' => Categorie::where('slug', 'officier-general')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Général De Brigade',
        'slug' => 'general-de-brigade',
        'categorie_id' => Categorie::where('slug', 'officier-general')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Général De Division',
        'slug' => 'general-de-division',
        'categorie_id' => Categorie::where('slug', 'officier-general')->first()->id,
      ]);
      DB::table('grades')->insert([
        'grade' => 'Général De Corps D\'Armée',
        'slug' => 'general-de-corps-d-armee',
        'categorie_id' => Categorie::where('slug', 'officier-general')->first()->id,
      ]);
    }
}
