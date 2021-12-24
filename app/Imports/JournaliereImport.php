<?php

namespace App\Imports;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Liste;
use App\SousListe;
use App\Deplacement;
use App\Militaire;
use App\Organe;
use App\Statut;
use App\Grade;

class JournaliereImport implements OnEachRow, WithValidation, WithHeadingRow
{
    protected $liste, $sousList;

    public function __construct(int $liste)
    {
      $this->liste = $liste;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\onRow|null
    */
    public function onRow(Row $row)
    {
      $grades = Grade::get()->pluck('slug');

      $data = $row->toArray();

      Validator::make($data, [
        'nom' => 'required|string',
        'prenom' => 'required|string',
        'grade' => ['required', Rule::in($grades)],
        'cne' => 'required',
        'mle' => 'required',
      ])->validate();

      if(!$this->sousList) {
        $this->sousList = SousListe::create([
          'liste_id' => $this->liste,
          'statut_id' => Statut::where('slug', 'journaliere')->first()->id,
        ]);
      }

      $cells = $row->toArray();

      $militaire = Militaire::find($cells['cne']);

      if(!$militaire) {
        $militaire =  Militaire::create([
          'cne' => $cells['cne'],
          'nom' => $cells['nom'],
          'prenom' => $cells['prenom'],
          'matricule' => $cells['mle'],
          'marie' => in_array($cells['sf'], ['C','c'])  ? false : true,
          'grade_id' => Grade::where('slug', $cells['grade'])->first()->id]);
      }

      $deplacement = Deplacement::create(
        ['depart' => $cells['du'],
        'arrivee' => $cells['au'],
        'mission' => $cells['mission'],
        'reference' => $cells['references'],
        'sous_liste_id' => $this->sousList->id,
        'statut_id' => Statut::where('slug', 'en-instance')->first()->id,
        'cne' => $militaire->cne]);

      return;
    }

    public function rules(): array
    {
        return [
          'sf' => ['required', Rule::in(['C','c','M','m', 'd', 'D'])],
          'du' => 'required|date_format:d.m.y H:i',
          'au' => 'required|date_format:d.m.y H:i',
          'mission' => 'required',
          'references' => 'required',
        ];
    }
}
