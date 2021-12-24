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

        $data['fileName'] = $this->fileName;

        Validator::make($data, [
          'fileName' => ['required', Rule::in($organes)],
        ])->validate();

        $liste = Liste::create(['numero' => Liste::whereYear('date', now()->year)->max('numero') + 1 ?? 1,
                                            'date' => now(),
                                            'organe_id' => Organe::where('organe', $this->fileName)->first()->id]);
        return [
            'journalier' => new JournaliereImport($liste->id),
            'exceptionnel' => new ExceptionnelleImport($liste->id),
            'temporaire' => new TemporaireImport($liste->id),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Claseur {$sheetName} est ignorée");
    }
}
