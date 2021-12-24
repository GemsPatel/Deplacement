<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model 
{

    protected $table = 'grades';
    public $timestamps = false;
    protected $fillable = array('grade', 'slug');

    public function militaires()
    {
        return $this->hasMany('Militaire', 'grade_id');
    }

    public function categorie()
    {
        return $this->belongsTo('Categorie', 'categorie_id');
    }

}