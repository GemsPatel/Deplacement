<?php

namespace App\Imports;

use App\Liste;
use App\Deplacement;
use App\Militaire;
use App\Organe;
use App\Statut;
use App\Grade;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class ListeImport implements WithMultipleSheets, SkipsUnknownSheets
{
    protected $fileName;

    public function fromFile(string $fileName)
    {
      $this->fileName = $fileName;
      return $this;
    }

    public function sheets(): array
    {
        $organes = Organe::pluck('organe')->toArray();
        
        if( !in_array( $this->fileName, $organes ) ){
          $organe = new Organe();
          $organe->organe = $this->fileName;
          $organe->inspection_id = 1;
          $organe->save();
        }

        $data['fileName'] = $this->fileName;

        $liste = new Liste ();
        $liste->numero =  Liste::whereYear('date', now()->year)->max('numero') + 1 ?? 1;
        $liste->date = now();
        $liste->organe_id = Organe::where('organe', $this->fileName)->first()->id;
        $liste->save();

        return [
            'JOURNALIER(NORMALE)' => new JournaliereImport($liste->id),
            'ABSENCE' => new ExceptionnelleImport($liste->id),
            'EXCEPTIONNELS' => new TemporaireImport($liste->id),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Claseur {$sheetName} est ignorée");
    }
}
