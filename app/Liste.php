<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liste extends Model
{

    protected $table = 'listes';
    public $timestamps = true;
    protected $fillable = array('numero', 'date', 'organe_id');

    public function organe()
    {
        return $this->belongsTo(Organe::class, 'organe_id');
    }

    public function sousListes()
    {
        return $this->hasMany(SousListe::class, 'liste_id');
    }

}
