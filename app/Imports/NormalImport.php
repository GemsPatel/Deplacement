<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\SousListe;
use App\Deplacement;
use App\Militaire;
use App\Statut;
use App\Grade;
use Illuminate\Validation\Rule;

class NormalImport implements ToModel, WithHeadingRow
{
    protected $liste_id, $sousList;

    public function __construct(int $liste_id)
    {
      $this->liste_id = $liste_id;
    }

    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
      $grades = Grade::get()->pluck('slug');

      $data = $row;//->toArray();
      Validator::make($data, [
        'nom' => 'required|string',
        'prenom' => 'required|string',
        'grade' => ['required', Rule::in($grades)],
        'cne' => 'required',
        'mle' => 'required',
      ])->validate();

      if(!$this->sousList) {
        $this->sousList = SousListe::create([
          'liste_id' => $this->liste_id,
          'statut_id' => Statut::where('slug', 'journaliere')->first()->id,
        ]);
      }

      $cells = $row;//->toArray();

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
    }
}