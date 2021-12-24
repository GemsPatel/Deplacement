<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model 
{

    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = array('slug');

    public function grades()
    {
        return $this->hasMany('Grade', 'categorie_id');
    }

}