<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Deplacement;

class DeplacementAccorde extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deplacement:accorde';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill depart and arrive accorde in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->warn('START');
        $this->warn('GET DEPLACEMENTS FROM DATABASE');

        $deplacements = Deplacement::all();

        $bar = $this->output->createProgressBar(count($deplacements));

        $depart = 0;
        $arrivee = 0;

        foreach ($deplacements as $key => $deplacement) {
          if(is_null($deplacement->departAccorde)) {
            $deplacement->departAccorde =  $deplacement->depart;
            $depart += 1;
          }

          if(is_null($deplacement->arriveeAccorde)) {
            $deplacement->arriveeAccorde =  $deplacement->arrivee;
            $arrivee += 1;
          }

          $deplacement->save();

          $bar->advance();
        }

        $this->warn(PHP_EOL.'DEPART '.$depart);
        $this->warn(PHP_EOL.'ARRIVEE '.$arrivee);
        $this->warn(PHP_EOL.'GET DEPLACEMENTS UPDATED SUCCESSFULLY!');
    }
}
