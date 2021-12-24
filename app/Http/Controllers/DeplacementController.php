<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DateRequest;
use App\Http\Requests\DeplacementRequest;
use App\Deplacement;
use App\Militaire;
use App\Liste;

class DeplacementController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(DeplacementRequest $request)
  {
    $input = $request->all();

    $liste = Liste::find($input['liste']);

    foreach ($input['statut_id'] as $key => $statut) {
      if($statut != '1') {    // TODO: change to ==
        return redirect()->back()->with('error', 'Veuillez spécifié le type de déplacement accordé!');
      }

      $deplacement = Deplacement::find($key);

      if(is_null($deplacement->departAccorde)) {
        $deplacement->departAccorde = $input['depart'][$key];
      }

      if(is_null($deplacement->arriveeAccorde)) {
        $deplacement->arriveeAccorde = $input['arrivee'][$key];
      }

      $deplacement->save();

      $deplacements = Deplacement::where('cne', $deplacement->cne)->where('id', '<>', $key)->get();

      foreach ($deplacements as $depl) {
        if(
          ($depl->departAccorde() >= $input['depart'][$key]
          && $depl->departAccorde() <= $input['depart'][$key])
                                          ||
          ($depl->arriveeAccorde() >= $input['arrivee'][$key]
          && $depl->arriveeAccorde() <= $input['arrivee'][$key])
          ) {
            return redirect()->back()->with('error', 'Il y a un chevauchement de dates pour le déplacement du '.$deplacement->militaire->fullname.' et celui du même militaire dans la liste N° '.$depl->sousListe->liste->numero);
          }
      }
    }

    return redirect(route('home.liste.show', $liste));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Liste $liste)
  {
    return view('view', compact('liste'))->with('success', 'Liste Enregistré avec succès');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {

  }

  /**
   * Update departAccorde field from storage.
   *
   * @param  Request  $request
   * @return Response
   */
  public function depart(DateRequest $request)
  {
    $deplacement = Deplacement::find($request->get('id'));

    if(empty($deplacement)) {
      return response()->json('Déplacement non trouvé', 404);
    }

    $deplacement->update(['departAccorde' => $request->get('date')]);

    return response()->json('Success');
  }

  /**
   * Update arriveeAccorde field from storage.
   *
   * @param  Request  $request
   * @return Response
   */
  public function arrivee(DateRequest $request)
  {
    $deplacement = Deplacement::find($request->get('id'));

    if(empty($deplacement)) {
      return response()->json('Déplacement non trouvé', 404);
    }

    $deplacement->update(['arriveeAccorde' => $request->get('date')]);

    return response()->json('Success');
  }

}

?>
