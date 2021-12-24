<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Militaire extends Model
{

    protected $table = 'militaires';
    public $timestamps = true;
    protected $primaryKey = 'cne';
    public $incrementing = false;
    protected $fillable = array('cne', 'nom', 'prenom', 'marie', 'cne', 'matricule', 'grade_id');

    public function deplacements()
    {
        return $this->hasMany('Deplacement', 'militaire_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function getFullNameAttribute()
    {
      return "{$this->nom} {$this->prenom}";
    }

}
