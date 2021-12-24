<?php

namespace App\Imports;

use App\Liste;
use App\Organe;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class ExcelSheetDataImport implements WithMultipleSheets
{
    use WithConditionalSheets;

    protected $fileName;

    public function fromFile(string $fileName)
    {
      $this->fileName = $fileName;
      return $this;
    }

    public function conditionalSheets(): array
    {
        $organes = Organe::pluck('organe')->toArray();
        
        if( !in_array( $this->fileName, $organes ) ){
          $organe = new Organe();
          $organe->organe = $this->fileName;
          $organe->inspection_id = 1;
          $organe->save();
        }

        $data['fileName'] = $this->fileName;

        $liste = new Liste();
        $liste->numero =  Liste::whereYear('date', now()->year)->max('numero') + 1 ?? 1;
        $liste->date = now();
        $liste->organe_id = Organe::where('organe', $this->fileName)->first()->id;
        $liste->save();
        
        return [
            'JOURNALIER(NORMALE)' => new NormalImport($liste->id),
            'ABSENCE'  => new AbsenceImport($liste->id),
            'EXCEPTIONNELS' => new ExceptionImport($liste->id)
        ];
    }
}
