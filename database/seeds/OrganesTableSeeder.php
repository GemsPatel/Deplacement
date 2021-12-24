<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organes')->insert([
          'organe' => 'Inspection Artillerie',
          'inspection_id' => 1,
        ]);
        DB::table('organes')->insert([
          'organe' => '3°GAR',
          'inspection_id' => 1,
        ]);
    }
}
