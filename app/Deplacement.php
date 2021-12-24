<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Deplacement extends Model
{

    protected $table = 'deplacements';
    public $timestamps = true;

    protected $fillable = ['depart', 'departAccorde', 'arrivee', 'arriveeAccorde', 'mission',
                           'reference', 'statut_id', 'sous_liste_id', 'cne'];

    public function statut()
    {
        return $this->belongsTo(Statut::class, 'statut_id');
    }

    public function militaire()
    {
        return $this->belongsTo(Militaire::class, 'cne');
    }

    public function sousListe()
    {
        return $this->belongsTo(SousListe::class, 'sous_liste_id');
    }

    public function depart()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->depart)->format('d-m-Y H:i');
    }

    public function arrivee()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->arrivee)->format('d-m-Y H:i');
    }

    public function departAccorde()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->departAccorde)->format('d-m-Y H:i');
    }

    public function arriveeAccorde()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->arriveeAccorde)->format('d-m-Y H:i');
    }
}
