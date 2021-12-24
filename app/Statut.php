<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statut extends Model 
{

    protected $table = 'statuts';
    public $timestamps = false;
    protected $fillable = array('statut', 'slug');

    public function deplacements()
    {
        return $this->hasMany('Deplacement', 'statut_id');
    }

}