<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SousListe extends Model
{

    protected $table = 'sous_listes';
    public $timestamps = true;
    protected $fillable = array('statut_id', 'liste_id');

    public function liste()
    {
        return $this->belongsTo(Liste::class, 'liste_id');
    }

    public function deplacements()
    {
        return $this->hasMany(Deplacement::class, 'sous_liste_id');
    }

    public function statut()
    {
      return $this->belongsTo(Statut::class, 'statut_id');
    }
}
