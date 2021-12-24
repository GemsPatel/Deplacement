<?php

namespace App\Imports;

use App\Deplacement;
use App\Exception;
use App\Grade;
use App\Militaire;
use App\SousListe;
use App\Statut;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;

class ExceptionImport implements ToModel, WithHeadingRow
{
    protected $liste, $sousList;

    public function __construct(int $liste)
    {
      $this->liste = $liste;
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
        $sl = new SousListe();
        $sl->liste_id = $this->liste;
        $sl->statut_id = Statut::where('slug', 'absence-temporaire')->first()->id;
        $sl->save();

        // $this->sousList = SousListe::create([
        //   'liste_id' => $this->liste,
        //   'statut_id' => Statut::where('slug', 'absence-temporaire')->first()->id,
        // ]);
      }

      $cells = $row;//->toArray();

      $militaire = Militaire::find($cells['cne']);

      if(!$militaire) {

        $mil = new Militaire();
        $mil->cne = $cells['cne'];
        $mil->nom = $cells['nom'];
        $mil->prenom = $cells['prenom'];
        $mil->matricule = $cells['matricule'];
        $mil->marie = in_array($cells['sf'], ['C','c'])  ? false : true;
        $mil->grade_id = Grade::where('slug', $cells['grade'])->first()->id;
        $mil->save();

        // $militaire =  Militaire::create([
        //   'cne' => $cells['cne'],
        //   'nom' => $cells['nom'],
        //   'prenom' => $cells['prenom'],
        //   'matricule' => $cells['mle'],
        //   'marie' => in_array($cells['sf'], ['C','c'])  ? false : true,
        //   'grade_id' => Grade::where('slug', $cells['grade'])->first()->id]);
      }

        $deplacement = new Deplacement();
        $deplacement->depart = $cells['du'];
        $deplacement->arrivee = $cells['au'];
        $deplacement->mission = $cells['mission'];
        $deplacement->reference = $cells['references'];
        $deplacement->sous_liste_id = $this->sousList->id;
        $deplacement->statut_id = Statut::where('slug', 'en-instance')->first()->id;
        $deplacement->cne = $militaire->cne;
        $deplacement->save();

    //   $deplacement = Deplacement::create(
    //     ['depart' => $cells['du'],
    //     'arrivee' => $cells['au'],
    //     'mission' => $cells['mission'],
    //     'reference' => $cells['references'],
    //     'sous_liste_id' => $this->sousList->id,
    //     'statut_id' => Statut::where('slug', 'en-instance')->first()->id,
    //     'cne' => $militaire->cne]);
    }
}