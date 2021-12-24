<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organe extends Model 
{

    protected $table = 'organes';
    public $timestamps = false;
    protected $fillable = array('organe', 'inspection_id');

    public function inspection()
    {
        return $this->hasOne('Organe', 'inspection_id');
    }

    public function listes()
    {
        return $this->hasMany('Liste', 'organe_id');
    }

}